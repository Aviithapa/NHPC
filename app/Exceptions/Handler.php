<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
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
     *
     * @return void
     */
    public function register()
    {
        $this->renderable(function (ThrottleRequestsException $e, $request) {
            return response()->view('errors.429', [], 429);
        });

        // $this->renderable(function (QueryException $e, $request) {
        //     return response()->view('errors.database', [], 500);
        // });

        $this->renderable(function (HttpException $e, $request) {
            $statusCode = $e->getStatusCode();
            if ($statusCode == 404) {
                return response()->view('errors.404', [], $statusCode);
            }
        });


        $this->reportable(function (Throwable $e) {
            //
        });
    }
}
