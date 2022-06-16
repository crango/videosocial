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
        $router->post('/states/{country}', [App\Http\Controllers\AuthController::class, 'states'])->name('states');
        $router->post('/cities/{state}', [App\Http\Controllers\AuthController::class, 'cities'])->name('cities');
        $router->get('/reset-password', [App\Http\Controllers\AuthController::class, 'reset_password'])->name('reset-password');
        $router->post('/reset-password', [App\Http\Controllers\AuthController::class, 'reset_password']);
        $router->get('/forgot-password', [App\Http\Controllers\AuthController::class, 'forgot_password'])->name('forgot-password');
        $router->post('/forgot-password', [App\Http\Controllers\AuthController::class, 'forgot_password']);
        $router->get('/logout', function () {
            auth()->logout();
            return redirect()->route('login');
        })->name('auth.logout');
    });
});
