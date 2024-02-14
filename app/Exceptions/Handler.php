<?php

namespace App\Exceptions;

use App\Traits\GeneralResponse;
use Cassandra\Exception\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    use GeneralResponse;
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    protected function unauthenticated($request, AuthenticationException|\Illuminate\Auth\AuthenticationException $exception)
    {
       if($request->hasHeader('lang')){
           $lang=$request->header('lang');
           app()->setLocale($lang);
       }
        if ($request->expectsJson()) {
            return $this->error(401,trans('response.Unauthenticated'));
        }
        return redirect()->guest('login');
    }
}

