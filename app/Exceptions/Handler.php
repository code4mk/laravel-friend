<?php

namespace App\Exceptions;

use Throwable;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
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
        $this->renderable(function (QueryException $e, Request $request) {
            $data = [
                'type' => 'QueryException',
                'code' => 500,
                'message' => $e->getMessage(),
                'errors' => $e,
            ];

            return response()->json($data, 500);
        });

        $this->reportable(function (Throwable $e) {
            //
        });
    }
}
