<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
Route::group(['prefix' => '/'], function ($router) {
    $router->get('/', function () {
        return redirect(route('login'));
    })->name('home');

    $router->group(['prefix' => 'auth'], function () use ($router) {
        $router->get('/', [App\Http\Controllers\AuthController::class, 'login'])->name('login');
        $router->get('/login', [App\Http\Controllers\AuthController::class, 'login']);
        $router->post('/login', [App\Http\Controllers\AuthController::class, 'login']);
        $router->get('/register', [App\Http\Controllers\AuthController::class, 'register'])->name('register');
        $router->post('/register', [App\Http\Controllers\AuthController::class, 'register']);
        $router->get('/reset-password', [App\Http\Controllers\AuthController::class, 'reset_password'])->name('reset-password');
        $router->post('/reset-password', [App\Http\Controllers\AuthController::class, 'reset_password']);
        $router->get('/forgot-password', [App\Http\Controllers\AuthController::class, 'forgot_password'])->name('forgot-password');
        $router->post('/forgot-password', [App\Http\Controllers\AuthController::class, 'forgot_password']);
        /*         $router->get('/logout', function () {
            auth()->logout();
            return redirect()->route('login');
        })->name('auth.logout'); */
    });

    $router->get('/states/{country}', [App\Http\Controllers\AuthController::class, 'states'])->name('states');
    $router->get('/cities/{state}', [App\Http\Controllers\AuthController::class, 'cities'])->name('cities');

    $router->group(['prefix' => '/', 'middleware' => ['web', 'auth:sanctum',]], function () use ($router) {
        $router->get('/logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('web.logout');

        $router->group(['prefix' => 'web', 'middleware' => 'auth'], function ($router) {
            # Dashboard Home
            $router->get('/home', [App\Http\Controllers\Web\HomeController::class, 'index'])->name('web');

            # Settings
            $router->group(['prefix' => 'settings'], function () use ($router) {
                # Profile
                $router->group(['prefix' => 'profile'], function () use ($router) {
                    $router->get('/', [App\Http\Controllers\Web\Settings\ProfileController::class, 'index'])->name('web.profile');
                    $router->post('/update', [App\Http\Controllers\Web\Settings\ProfileController::class, 'update']);
                });
            });
        });
    });
});
