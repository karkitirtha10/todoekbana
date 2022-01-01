<?php

namespace App\Providers;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //get data, add or update (generally bulk)
        Response::macro('ok', fn($data = null, $message = "successful!") => Response::json(
            [
                "message" => $message,
                'data' => $data,
                'errors' => null,
            ], 200)
        );

        //add resource
        Response::macro('createdAtAction',
            fn($data, ?string $resourceLocation = null, string $message = "successfully added new resource!") => Response::json(
                [
                    "message" => $message,
                    'data' => $data,
                    'errors' => null,
                ], 201)
                ->header("Location", $resourceLocation)
        );


        //Response::macro('noContentJson', fn() => Response::json([], 204)); // noContent is already in response class

        Response::macro('notFound', fn(string $message = "resource not found!!") => Response::json(
            [
                "message" => $message,
                'data' => null,
                'errors' => null,
            ], 404)
        );

        //client error
        Response::macro('badRequest', fn(string $message = "bad request !", $errors = null) => Response::json(
            [
                "message" => $message,
                'data' => null,
                'errors' => $errors,
            ], 400)
        );

        //validation errors
        Response::macro('badData', fn($errors, string $message = "the given data is invalid !") => Response::json(
            [
                "message" => $message,
                'data' => null,
                'errors' => $errors,
            ], 422)
        );

        //unAuthenticated
        Response::macro('unAuthenticated', fn(string $message = "unauthenticated!") => Response::json(
            [
                "message" => $message,
                'data' => null,
                'errors' => null,
            ], 401)
        );

        //Unauthorized
        Response::macro('forbidden', fn(string $message = "Unauthorized action!") => Response::json(
            [
                "message" => $message,
                'data' => null,
                'errors' => null,
            ], 403)
        );

        //internal server error
        Response::macro('serverError', fn(string $message = "internal server error!") => Response::json(
            [
                "message" => $message,
                'data' => null,
                'errors' => null,
            ], 500)
        );

        //http conflict //eg: cannot delete becoz already used. fir delete where it is used and try again
        Response::macro('conflict', fn(string $message = "cannot perform action due to conflict!") => Response::json(
            [
                "message" => $message,
                'data' => null,
                'errors' => null,
            ], 409)
        );
    }
}
