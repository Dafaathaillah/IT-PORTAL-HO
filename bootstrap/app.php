<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\HandleInertiaRequests;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Http\Request;


return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->web(append: [
            HandleInertiaRequests::class,
            \Illuminate\Http\Middleware\AddLinkHeadersForPreloadedAssets::class,
        ]);

        $middleware->alias([
            'Excel' => Maatwebsite\Excel\Facades\Excel::class,
            'api' => [
                \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
                'throttle:api',
                \Illuminate\Routing\Middleware\SubstituteBindings::class,
            ],
            'type.ict_developer' => \App\Http\Middleware\IctDeveloperMiddleware::class,
            'type.ict_section_head' => \App\Http\Middleware\IctSectionHead::class,
            'type.ict_group_leader' => \App\Http\Middleware\IctGroupLeader::class,
            'type.ict_admin' => \App\Http\Middleware\IctAdmin::class,
            'type.ict_technician' => \App\Http\Middleware\IctTechnician::class,
            // 'type.ict_guest' => \App\Http\Middleware\AdminMiddleware::class,
            'checkRole' => \App\Http\Middleware\CheckRole::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (NotFoundHttpException $exception, Request $request) {

            if ($request->is('/')) {
                return redirect('/login');
            }

            // if ($exception->getStatusCode() == 400) {
            //     return response()->view("admin.errors.400", [], 400);
            // }

            // if ($exception->getStatusCode() == 403) {
            //     return response()->view("admin.errors.403", [], 403);
            // }

            // if ($exception->getStatusCode() == 404) {
            //     return response()->view("admin.errors.404", [], 404);
            // }

            // if ($exception->getStatusCode() == 500) {
            //     return response()->view("admin.errors.500", [], 500);
            // }

            // if ($exception->getStatusCode() == 503) {
            //     return response()->view("admin.errors.503", [], 503);
            // }

        });

        // $exceptions->render(function (NotFoundHttpException $e, Request $request) {
        //     if ($request->is('api/*')) {
        //         return response()->json([
        //             'status' => 'false',
        //             'message' => 'Route Not found',
        //         ], 404);
        //     }
        // });
        // $exceptions->render(function (Throwable $e) {
        //     // dd($e);
        //     // if($e->message == 'Unauthenticated') {
        //     //     return 'okee';
        //     // }
        //     // if ($request->is('api/*')) {
        //         // return response()->json([
        //         //     'status' => 'false',
        //         //     'message' => 'Route Not found',
        //         // ], 404);
        //     // }

        //     return redirect('/');
        // });
    })->create();
