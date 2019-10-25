<?php

namespace App\Exceptions;

use Exception;
use App\Http\Traits\ApiResponse;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

use Illuminate\Support\Facades\Log;
use Illuminate\Validation\UnauthorizedException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\JWTAuthException;
use Tymon\JWTAuth\Exceptions\TokenBlacklistedException;

class Handler extends ExceptionHandler
{
    use ApiResponse;
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
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        // if(env('APP_ENV') == 'local') {
        //     return parent::render($request, $exception);
        // }

        if($request->is('api/*')) {
            $exceptionClass = get_class($exception);
            switch ($exceptionClass) {
                case HttpException::class:
                    $statusCode = $exception->getStatusCode();
                    $message = $exception->getMessage();
                    break;
                case NotFoundHttpException::class:
                    $statusCode =JsonResponse::HTTP_NOT_FOUND;
                    $message = __('messages.request_not_found');
                    break;
                case HttpResponseException::class:
                    $data = $exception->getResponse()->original;

                    $statusCode = $exception->getResponse()->getStatusCode();
                    $message = $data['meta']['message'];
                    break;
                case ValidationException::class:
                    $validationErrors = $exception->validator->errors();
                    $statusCode = JsonResponse::HTTP_UNPROCESSABLE_ENTITY;
                    $message = $validationErrors->getMessages();
                    break;
                case ModelNotFoundException::class:
                    $statusCode = JsonResponse::HTTP_NOT_FOUND;
                    $message = __('messages.request_not_found');
                    break;
                case AuthorizationException::class:
                    $statusCode = JsonResponse::HTTP_FORBIDDEN;
                    $message = __('messages.request_forbidden');
                    break;
                case BadRequestHttpException::class:
                    $statusCode = JsonResponse::HTTP_BAD_REQUEST;
                    break;
                case UnauthorizedException::class:
                    $statusCode = JsonResponse::HTTP_UNAUTHORIZED;
                    break;
                case UnauthorizedHttpException::class:
                    $statusCode = JsonResponse::HTTP_UNAUTHORIZED;
                    $message = __('auth.token_expire');
                    break;
                case TokenInvalidException::class:
                    $statusCode = JsonResponse::HTTP_UNAUTHORIZED;
                    $message = 'Token is Invalid';
                    break;
                case TokenExpiredException::class:
                    $statusCode = JsonResponse::HTTP_UNAUTHORIZED;
                    $message = 'Token is Expired';
                    break;
                case JWTException::class:
                    $statusCode = JsonResponse::HTTP_UNAUTHORIZED;
                    $message = 'Authorization Token not found';
                    break;
                case JWTAuthException::class:
                    $statusCode = JsonResponse::HTTP_FORBIDDEN;
                    $message = 'Create token fail';
                    break;
                case TokenBlacklistedException::class:
                    $statusCode = JsonResponse::HTTP_FORBIDDEN;
                    $message = 'The token has been deleted';
                    break;
                default:
                    $statusCode = JsonResponse::HTTP_INTERNAL_SERVER_ERROR;
                    $message = __('messages.server_error');
            }

            Log::info($exception->getMessage());
            return $this->jsonOut([
                'message' => $message,
                'statusCode' => $statusCode,
            ]);
        }

        if(env('APP_ENV') == 'local') {
            return parent::render($request, $exception);
        }

        if (isset($exception->status) && $exception->status === 401) {
            return redirect()->guest(route('login'));
        }
        return parent::render($request, $exception);
    }
}
