<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to your application's "home" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));

               // Route::middleware('auth')->group(function () {
                //    Route::get('/movies', [MovieController::class, 'index'])->name('movies.index');
                ////    Route::get('/movies/create', [MovieController::class, 'create'])->name('movies.create');
                //    Route::post('/movies', [MovieController::class, 'store'])->name('movies.store');
                //    Route::get('/movies/{movie}', [MovieController::class, 'show'])->name('movies.show');});
    });
}
}
