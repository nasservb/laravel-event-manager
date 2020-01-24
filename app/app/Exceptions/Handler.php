<?php

namespace App\Exceptions;

use App\Http\Resources\ErrorResource;
use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Database\Eloquent\ModelNotFoundException;
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
     * Reports or log an exception.
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
     * @param \Illuminate\Http\Request $request
     * @param Exception $exception
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response|\Symfony\Component\HttpFoundation\Response
     */
    public function render($request, Exception $exception)
    {

        if ( $request->is('api/*')) {


			if ($exception instanceof  ModelNotFoundException || $exception instanceof NotFoundHttpException) {
				// return your custom response
				return (new ErrorResource([
                            'message' => 'No resource was found',
                            'code' => 404]
                    ))->response()
                    ->setStatusCode(404);
			}
			elseif ($exception instanceof ValidationException)
			{
				$message = $exception->getMessage();
                return (new ErrorResource([
                        'message' => $message,
                        'code' => 401]
                ))->response()
                    ->setStatusCode(401);

			}
		}

        return parent::render($request, $exception);
    }
}
