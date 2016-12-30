<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        \Illuminate\Auth\AuthenticationException::class,
        \Illuminate\Auth\Access\AuthorizationException::class,
        \Symfony\Component\HttpKernel\Exception\HttpException::class,
        \Illuminate\Database\Eloquent\ModelNotFoundException::class,
        \Illuminate\Session\TokenMismatchException::class,
        \Illuminate\Validation\ValidationException::class,
        
        \App\Exceptions\ServiceException::class,
        \App\Exceptions\ValidationException::class,
        \App\Exceptions\JsonpException::class
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
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
    public function render($request, Exception $e)
    {
        $wantHttpStatus = $request->input('whs','no');
        \App\Http\Controllers\Controller::setHeader();
        $httpStatus = $e->getCode() == \JsonReturn::STATUS_OK ? \HttpStatus::HTTP_200 : \HttpStatus::HTTP_400;
        $wantHttpStatus == 'no' && $httpStatus = \HttpStatus::HTTP_200;
        
        if ($e instanceof \App\Exceptions\ServiceException) {
            return \JsonReturn::json($e->getCode(),$e->getMessage(), $e->getData(),$httpStatus);
        }
        if ($e instanceof \App\Exceptions\ValidationException) {
            return \JsonReturn::json($e->getCode(),$e->getMessage(), $e->getData(),$httpStatus);
        }
        if ($e instanceof \App\Exceptions\JsonpException) {
            return \JsonReturn::jsonp($e->getCode(),$e->getMessage(), $e->getData(),$httpStatus);
        }
        $wantHttpStatus == 'no' && $httpStatus = \HttpStatus::HTTP_500;
        
        if ($e instanceof \Symfony\Component\HttpKernel\Exception\NotFoundHttpException) {
            if ($request->ajax() || $request->wantsJson()) {
                return \JsonReturn::json($e->getCode(),'NotFoundHttpException', [],$httpStatus);
            }else{
                return redirect('/404');
            }
        }
        
        if ($e instanceof TokenMismatchException) {
            if ($request->ajax() || $request->wantsJson()) {
                return \JsonReturn::json(\ErrorCode::UNAUTHORIZED,'error', [],$httpStatus);
            }else{
                return redirect(route('developer'));
            }
        }
        
        if (! \Config::get('app.debug')) {
            return \JsonReturn::json($e->getCode(),$e->getMessage(), [],$httpStatus);
        }
        return parent::render($request, $e);
    }

    /**
     * Convert an authentication exception into an unauthenticated response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Auth\AuthenticationException  $exception
     * @return \Illuminate\Http\Response
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }

        return redirect()->guest('login');
    }
}
