<?php

namespace App\Http\Controllers\API;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use App\Mail\PasswordResetEmail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmailVerificationEmail;
use App\Http\Controllers\API\APIController;

/**
 * @group Authentication
 *
 * Application authentication
 */
class AuthAPIController extends APIController
{
    /**
     * Register
     *
     * Register new user account
     *
     * @bodyParam name string required User Name
     * @bodyParam email email required Email address
     * @bodyParam password string required Password
     * @bodyParam password_confirmation string required Password confirmation
     * @response {
     *     "success": true,
     *     "message": __('auth.register_success'),
     *     "data": {
     *         "id": 1,
     *         "name": "John Smith",
     *         "email": "john.smith@example.com"
     *     }
     * }
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {

        $validatedData = $request->validate([
            'name' => 'required|string|max:120',
            'email' => 'required|string|email|unique:users|max:100',
            'password' => 'required|string|confirmed|min:6|max:128'
        ]);

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
            'email_token' => base64_encode($validatedData['email'])
        ]);

        Mail::to($user)->send(new EmailVerificationEmail($user));

        return $this->sendSuccessResponse(__('auth.register_success'), $user);
    }

    /**
     * Verify
     *
     * Verify user email
     *
     * @bodyParam token string required Verify email token
     @response {
     *     "success": true,
     *     "message": __('verify_email.success'),
     *     "data": {
     *         "id": 1,
     *         "name": "John Smith",
     *         "email": "john.smith@example.com"
     *     }
     * }
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function verifyEmail(Request $request)
    {
        $validatedData = $request->validate([
            'token' => 'required|string'
        ]);

        $user = User::where('email_token', $validatedData['token'])->first();

        if (empty($user)) {
            return $this->sendErrorResponse(__('verify_email.token_not_exists'));
        }

        if (!empty($user->email_verified_at)) {
            return $this->sendErrorResponse(__('verify_email.token_used'));
        }

        $user->update(['email_verified_at' => Carbon::now()]);
        
        return $this->sendSuccessResponse(__('verify_email.success'), $user);
    }

    /**
     * Password reset send
     *
     * Send password reset email
     *
     * @bodyParam email string required Email address
     * @response {
     *     "success": true,
     *     "message": __('password_reset.sent_success'),
     *     "data": null
     * }
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendResetEmail(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|email'
        ]);

        if ($user = User::where('email', $validatedData['email'])->first()) {

            $token = str_random(64);

            DB::table(config('auth.passwords.users.table'))->where('email', $user->email)->delete();

            DB::table(config('auth.passwords.users.table'))->insert([
                'email' => $user->email,
                'token' => $token
            ]);

            Mail::to($user)->send(new PasswordResetEmail($user, $token));

            return $this->sendSuccessResponse(__('password_reset.sent_success'), null);
        }
        return $this->sendErrorResponse(__('password_reset.user_not_found'));
    }

    /**
     * Password reset update
     *
     * Update user password
     *
     * @bodyParam token string required Password reset token
     * @bodyParam password string required Password
     * @bodyParam password string required Password confirmation
     * @response {
     *     "success": true,
     *     "message": __('password_reset.success'),
     *     "data": {
     *         "id": 1,
     *         "first_name": "John",
     *         "last_name": "Smith",
     *         "email": "john.smith@example.com",
     *         "custom_fields": [
     *             "Custom field 1",
     *             "Custom field 2",
     *             "Custom field 3"
     *         ],
     *         "notification_to_patient_one_day_before_visit": true
     *         "notification_to_patient_two_days_before_visit": true
     *         "notification_to_patient_three_days_before_visit": true
     *         "hash_code": "xkOs0QiXOFz9",
     *         "email_verified_at": "2018-10-12 17:16:26",
     *         "ics_calendar_url": "https://edf.local/kalendarz-wizyt-ics/23f34f34",
     *         "created_at": "2018-10-12 17:15:25",
     *         "updated_at": "2018-10-20 20:29:40"
     *     }
     * }
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function resetPassword(Request $request)
    {
        $validatedData = $request->validate([
            'token' => 'required|string',
            'password' => 'required|string|confirmed|min:6|max:128'
        ]);

        $passwordReset = DB::table(config('auth.passwords.users.table'))
            ->where('token', $validatedData['token'])
            ->first();

        if (empty($passwordReset)) {
            return $this->sendErrorResponse( __('password_reset.token_not_valid'));
        }

        $user = User::where('email', $passwordReset->email)->first();

        if (empty($user)) {
            return $this->sendErrorResponse( __('password_reset.user_not_found'));
        }

        $user->update(['password' => bcrypt($validatedData['password'])]);

        DB::table(config('auth.passwords.users.table'))->where('email', $user->email)->delete();

        return $this->sendSuccessResponse(__('password_reset.success'), $user);
    }

    /**
     * Login
     *
     * user login and get token
     *
     * @bodyParam email email required Email address
     * @bodyParam password string required Password
     * @bodyParam remember_me boolean optional Remember me option
     * @response {
     *     "success": true,
     *     "message": __('auth.success'),
     *     "data": {
     *         "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImYxZjU2ZTE0YWIwYjM2MWVmY2ZkMGFiNTQ5N2Q0YTcyM2I1MDY3YjJiMzNlNTYyMTQ2NzUxZDQzNmMzOTgzZWI3ZDk0OTY1MTAwY2QzN2U1In0.eyJhdWQiOiIxIiwianRpIjoiZjFmNTZlMTRhYjBiMzYxZWZjZmQwYWI1NDk3ZDRhNzIzYjUwNjdiMmIzM2U1NjIxNDY3NTFkNDM2YzM5ODNlYjdkOTQ5NjUxMDBjZDM3ZTUiLCJpYXQiOjE1MzkzNjU4NDQsIm5iZiI6MTUzOTM2NTg0NCwiZXhwIjoxNTcwOTAxODQ0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.TX8xj0yI_y-aVTDZApBWAwZ39ehacAbAkb5mJEF5fVks8iqy8Hz08FREJT3AcmU2iWYD0KlB_XjFXMi0uAuJgDr7BLWHbuQhzZCg4q1DLD3uv8HpnyqnthbYjVIbCfWtbikrz6HxzO3fl3wTEhGjf9YWCXkB-CmJDds0NNlOKoFYIvvVrY1sbKvziPZXN-6gD8YZwLt_cylIu2ypbw6UQcZc-VTyU8lPyJGI2v0PMLSmI66yfaWjODbuNzyyQlsUncIuHSuosW4CtxxQuzk4gutovMce8GYPrLvmTboLQf0VRdvl4sECZGTVVbFIMuavCWQpuIE_okL61DfOLgne8_5e0hFY4Y8xos_IS9g4ca6lqdg8_h3agi2pSrqZ9wBYpwcDyYdtkt5n-pIjspU_V4fP9gnPeSfAU53cwBQSOKS0lnvMudjj2CPvEQIgZhkMaHLBGzhySAfscCNz09TSjvqN_Cu1T4xpYK9OKqJGGbjVcJdMbvwexy9XjcT5F-9J5fhql-268p1VoUTbiIj2tHBBH4hGl9X4QDr0OtJR9pydJ8pAQDOxuu9bx6dC5nOBQAedv2CodsknfuPefsAsBXZD8GJeR59ih1wY6VlvmwhhTB9SVjJLhPkX_3FsDjq_Tc3YRUoV-WgZp3-rXvVpNAJwzv-KBS5mG6r__lltbnA",
     *         "token_expires_at": "2018-10-19 17:37:24"
     *     }
     * }
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
            'remember_me' => 'boolean'
        ]);

        $credentials = [
            'email' => $validatedData['email'],
            'password' => $validatedData['password']
        ];

        if (!Auth::attempt($credentials)) {
            return $this->sendErrorResponse(__('auth.failed'), null, 401);
        }

        $user = $request->user();

        if(null === $user->email_verified_at)
            return $this->sendErrorResponse(__('auth.email_not_verified'));

        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        if (isset($validatedData['remember_me']) && $validatedData['remember_me']) {
            $token->expires_at = Carbon::now()->addWeeks(1);
        }
        $token->save();

        return $this->sendSuccessResponse(__('auth.success'), [
            'token' => $tokenResult->accessToken,
            'token_expires_at' => Carbon::parse($tokenResult->token->expires_at)->toDateTimeString()
        ]);
    }

    /**
     * Logout
     *
     * user logout and revoke token
     *
     * @authenticated
     * @response {
     *     "success": true,
     *     "message": __('auth.logout_success'),
     *     "data": {}
     * }
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        $user = $request->user();

        if(null === $user)
            return $this->sendErrorResponse(__('auth.logout_failed'));

        $user->token()->revoke();

        return $this->sendSuccessResponse(__('auth.logout_success'));
    }

    /**
     * User
     *
     * Get current logged in user
     *
     * @authenticated
     * @response {
     *     "success": true,
     *     "message": "Pobrano dane aktualnego użytkonika pomyślnie",
     *     "data": {
     *         "id": 1,
     *         "first_name": "John",
     *         "last_name": "Smith",
     *         "email": "john.smith@example.com",
     *         "custom_fields": [
     *             "Custom field 1",
     *             "Custom field 2",
     *             "Custom field 3"
     *         ],
     *         "notification_to_patient_one_day_before_visit": true
     *         "notification_to_patient_two_days_before_visit": true
     *         "notification_to_patient_three_days_before_visit": true
     *         "hash_code": "xkOs0QiXOFz9",
     *         "email_verified_at": "2018-10-12 17:16:26",
     *         "ics_calendar_url": "https://edf.local/kalendarz-wizyt-ics/23f34f34",
     *         "created_at": "2018-10-12 17:15:25",
     *         "updated_at": "2018-10-20 20:29:40"
     *     }
     * }
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function user(Request $request)
    {
        return $this->sendSuccessResponse(__('user.fetch_success'), $request->user());
    }

    /**
     * Refresh token
     *
     * Refresh token for current logged in user
     *
     * @authenticated
     * @bodyParam remember_me boolean optional Remember me option
     * @response {
     *     "success": true,
     *     "message": __('auth.token_refresh_success'),
     *     "data": {
     *         "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImYxZjU2ZTE0YWIwYjM2MWVmY2ZkMGFiNTQ5N2Q0YTcyM2I1MDY3YjJiMzNlNTYyMTQ2NzUxZDQzNmMzOTgzZWI3ZDk0OTY1MTAwY2QzN2U1In0.eyJhdWQiOiIxIiwianRpIjoiZjFmNTZlMTRhYjBiMzYxZWZjZmQwYWI1NDk3ZDRhNzIzYjUwNjdiMmIzM2U1NjIxNDY3NTFkNDM2YzM5ODNlYjdkOTQ5NjUxMDBjZDM3ZTUiLCJpYXQiOjE1MzkzNjU4NDQsIm5iZiI6MTUzOTM2NTg0NCwiZXhwIjoxNTcwOTAxODQ0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.TX8xj0yI_y-aVTDZApBWAwZ39ehacAbAkb5mJEF5fVks8iqy8Hz08FREJT3AcmU2iWYD0KlB_XjFXMi0uAuJgDr7BLWHbuQhzZCg4q1DLD3uv8HpnyqnthbYjVIbCfWtbikrz6HxzO3fl3wTEhGjf9YWCXkB-CmJDds0NNlOKoFYIvvVrY1sbKvziPZXN-6gD8YZwLt_cylIu2ypbw6UQcZc-VTyU8lPyJGI2v0PMLSmI66yfaWjODbuNzyyQlsUncIuHSuosW4CtxxQuzk4gutovMce8GYPrLvmTboLQf0VRdvl4sECZGTVVbFIMuavCWQpuIE_okL61DfOLgne8_5e0hFY4Y8xos_IS9g4ca6lqdg8_h3agi2pSrqZ9wBYpwcDyYdtkt5n-pIjspU_V4fP9gnPeSfAU53cwBQSOKS0lnvMudjj2CPvEQIgZhkMaHLBGzhySAfscCNz09TSjvqN_Cu1T4xpYK9OKqJGGbjVcJdMbvwexy9XjcT5F-9J5fhql-268p1VoUTbiIj2tHBBH4hGl9X4QDr0OtJR9pydJ8pAQDOxuu9bx6dC5nOBQAedv2CodsknfuPefsAsBXZD8GJeR59ih1wY6VlvmwhhTB9SVjJLhPkX_3FsDjq_Tc3YRUoV-WgZp3-rXvVpNAJwzv-KBS5mG6r__lltbnA",
     *         "token_expires_at": "2018-10-19 17:37:24"
     *     }
     * }
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function refreshToken(Request $request)
    {
        $validatedData = $request->validate([
            'remember_me' => 'boolean'
        ]);

        $user = $request->user();

        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        if (isset($validatedData['remember_me']) && $validatedData['remember_me']) {
            $token->expires_at = Carbon::now()->addWeeks(1);
        }
        $token->save();

        return $this->sendSuccessResponse(__('auth.token_refresh_success'), [
            'token' => $tokenResult->accessToken,
            'token_expires_at' => Carbon::parse($tokenResult->token->expires_at)->toDateTimeString()
        ]);
    }


}
