<?php

namespace App\Exceptions;

use Exception;
use HttpResponseException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Routing\Router;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Exception $exception
     * @return void
     * @throws Exception
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into a response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $e
     * @return \Illuminate\Http\Response|\Symfony\Component\HttpFoundation\Response
     */
    public function render($request, Exception $e)
    {
        if (method_exists($e, 'render') && $response = $e->render($request)) {
            return Router::toResponse($request, $response);
        } elseif ($e instanceof Responsable) {
            return $e->toResponse($request);
        }

        $e = $this->prepareException($e);

        if ($request->expectsJson()) {
            if ($e instanceof HttpResponseException) {
                return $this->prepareJsonResponseForHttpResponseException($e);
            } elseif ($e instanceof AuthenticationException) {
                return $this->prepareJsonResponseForAuthenticationException($e);
            } elseif ($e instanceof ValidationException) {
                return $this->prepareJsonResponseForValidationException($e);
            } elseif ($e instanceof NotFoundHttpException) {
                return $this->prepareJsonResponseForNotFoundHttpException($e);
            } else {
                return $this->prepareJsonResponseForCustomException($e);
            }
        } else {
            $this->prepareResponse($request, $e);
        }
    }

    /**
     * Get JSON error response format
     *
     * @param $message
     * @param array $data
     * @param int $code
     * @return \Illuminate\Http\JsonResponse
     */
    protected function getJsonResponse($message, $data = [], $code = 500)
    {
        return response()->json(
            [
                'success' => false,
                'message' => $message,
                'data' =>  $data
            ],
            $code,
            [],
            JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES
        );
    }

    /**
     * Prepare JSON response for HttpResponseException
     *
     * @param HttpResponseException $exception
     * @return \Illuminate\Http\JsonResponse
     */
    protected function prepareJsonResponseForHttpResponseException(HttpResponseException $exception)
    {
        if (config('app.debug')) {
            return $this->getJsonResponse(__('exception.http_error'), ['exception_data' => $this->convertExceptionToArray($exception)], $this->isHttpException($exception) ? $exception->getStatusCode() : 500);
        } else {
            return $this->getJsonResponse(__('exception.http_error'), [], $this->isHttpException($exception) ? $exception->getStatusCode() : 500);
        }
    }

    /**
     * Prepare JSON response for AuthenticationException
     *
     * @param AuthenticationException $exception
     * @return \Illuminate\Http\JsonResponse
     */
    protected function prepareJsonResponseForAuthenticationException(AuthenticationException $exception)
    {
        if (config('app.debug')) {
            return $this->getJsonResponse(__('exception.not_authorized'), ['exception_data' => $this->convertExceptionToArray($exception)], 401);
        } else {
            return $this->getJsonResponse(__('exception.not_authorized'), [], 401);
        }
    }

    /**
     * Prepare JSON response for ValidationException
     *
     * @param ValidationException $exception
     * @return \Illuminate\Http\JsonResponse|null|\Symfony\Component\HttpFoundation\Response
     */
    protected function prepareJsonResponseForValidationException(ValidationException $exception)
    {
        if ($exception->response) {
            return $exception->response;
        }
        if (config('app.debug')) {
            return $this->getJsonResponse(__('exception.validation_faulty'), ['validation_errors' => $exception->errors(), 'exception_data' => $this->convertExceptionToArray($exception)], 422);
        } else {
            return $this->getJsonResponse(__('exception.validation_faulty'), ['validation_errors' => $exception->errors()], 422);
        }
    }

    /**
     * Prepare JSON response for NotFoundHttpException
     *
     * @param NotFoundHttpException $exception
     * @return \Illuminate\Http\JsonResponse
     */
    protected function prepareJsonResponseForNotFoundHttpException(NotFoundHttpException $exception)
    {
        if (config('app.debug')) {
            return $this->getJsonResponse(__('exception.not_found'), ['exception_data' => $this->convertExceptionToArray($exception)], 404);
        } else {
            return $this->getJsonResponse(__('exception.not_found'), [], 404);
        }
    }

    /**
     * Prepare JSON response for any custom exception
     *
     * @param $exception
     * @return \Illuminate\Http\JsonResponse
     */
    protected function prepareJsonResponseForCustomException($exception)
    {
        if (config('app.debug')) {
            return $this->getJsonResponse(__('exception.server_error'), ['exception_data' => $this->convertExceptionToArray($exception)], $this->isHttpException($exception) ? $exception->getStatusCode() : 500);
        } else {
            return $this->getJsonResponse(__('exception.server_error'), [], $this->isHttpException($exception) ? $exception->getStatusCode() : 500);
        }
    }
}