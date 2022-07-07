<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\Settings\AccountController;
use App\Http\Controllers\Web\Settings\ProfileController;
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
        $router->get('/', [AuthController::class, 'login'])->name('login');
        $router->get('/login', [AuthController::class, 'login']);
        $router->post('/login', [AuthController::class, 'login']);
        $router->get('/register', [AuthController::class, 'register'])->name('register');
        $router->post('/register', [AuthController::class, 'register']);
        $router->get('/reset-password', [AuthController::class, 'reset_password'])->name('reset-password');
        $router->post('/reset-password', [AuthController::class, 'reset_password']);
        $router->get('/forgot-password', [AuthController::class, 'forgot_password'])->name('forgot-password');
        $router->post('/forgot-password', [AuthController::class, 'forgot_password']);

        //  $router->get('/home', [AuthController::class, 'web'])->middleware(['auth', 'is_verify_email'])->name('web');
        $router->get('verify/{token}', [AuthController::class, 'verifyAccount'])->name('user.verify');
    });

    $router->get('/states/{country}', [AuthController::class, 'states'])->name('states');
    $router->get('/cities/{state}', [AuthController::class, 'cities'])->name('cities');

    $router->group(['prefix' => '/', 'middleware' => ['web', 'auth:sanctum',]], function () use ($router) {
        $router->get('/logout', [AuthController::class, 'logout'])->name('web.logout');

        $router->group(['prefix' => 'web', 'middleware' => 'auth'], function ($router) {
            # Dashboard Home
            $router->get('/home', [HomeController::class, 'index'])->name('web.home');

            # Settings
            $router->group(['prefix' => 'settings'], function () use ($router) {

                # Profile
                $router->group(['prefix' => 'profile'], function () use ($router) {
                    $router->get('/', [ProfileController::class, 'index'])->name('web.profile');
                    $router->post('/update', [ProfileController::class, 'update']);
                });

                #account
                $router->group(['prefix' => 'account'], function () use ($router) {
                    $router->get('/', [AccountController::class, 'index'])->name('web.account');
                });
            });
        });
    });
});
