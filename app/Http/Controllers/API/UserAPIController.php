<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;

class UserAPIController extends APIController
{
    private $validationRules = [
        'first_name' => 'required|string|max:30',
        'last_name' => 'required|string|max:30',
        'job_title' => 'string|max:60',
        'site_id' => 'numeric|nullable',
        'email' => 'email|nullable',
        'phone' => 'string|nullable|max:16',
        'mobile' => 'string|nullable|max:16',
        'description' => 'string|nullable|max:500'
    ];
     /**
     * List
     *
     * Get list of all users
     * @authenticated
     * @response {}
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */

    public function index(Request $request)
    {
        $withTrashed = !!$request->input('with_trashed');

        $users = User::select('id', 'first_name', 'last_name', 'job_title', 'site_id', 'deleted_at')
                        ->withTrashed($withTrashed)
                        ->with(array('site' => function($query) {
                            $query->select('id', 'name');
                        }))
                        ->withCount('assets')
                        ->get();

        return $this->sendSuccessResponse(__('users.fetch_success'), $users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate($this->validationRules);

        $user = User::create($data);

        return $this->sendSuccessResponse(__('users.store_success'), $user);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::withTrashed()->findOrFail($id);

        return $this->sendSuccessResponse(__('users.fetch_success'), $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $user = User::withTrashed()->findOrFail($id);


        if( 'restore' === $request->input('action')) {
            $user->restore();
            return $this->sendSuccessResponse(__('users.restore_success'), $user);
        }

        $data = $request->validate($this->validationRules);

        $user->update($data);

        //update code

        return $this->sendSuccessResponse(__('users.update_success'), $user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($userId, Request $request)
    {
        $user = User::withTrashed()->find($userId);

        if(empty($user))
            return $this->sendErrorResponse(__('users.destroy_not_found'), null, 404);

        if('true' === $request->input('permanently')) {
            $user->forceDelete();
            return $this->sendSuccessResponse(__('users.destroy_p_success'));
        }

        $user->delete();
        return $this->sendSuccessResponse(__('users.destroy_success'));
    }
}
