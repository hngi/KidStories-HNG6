<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

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
        $this->JsonModelNotFoundExceptionHandler($request,$exception);

        $this->CsrfTokenExpirationHandler($request,$exception);
        
        return parent::render($request, $exception);
    }

    protected function JsonModelNotFoundExceptionHandler($request, $exception)
    {
        if ($exception instanceof ModelNotFoundException && $request->wantsJson()) {
            return response()->json([
              'error' => 'Resource not found',
              'message' => 'Not found',
              'code' => 404
            ], 404);
        }
    }

    protected function CsrfTokenExpirationHandler($request, $exception)
    {
        if ($exception instanceof TokenMismatchException) {
            return redirect()
                ->back()
                ->withInput($request->except('password', 'password_confirmation', '_token'))
                ->with(['error' => 'Your form has expired. Please try again']);
        }

    }

}
