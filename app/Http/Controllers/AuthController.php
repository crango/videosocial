<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Country;
use App\Models\State;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    var $request;
    var $model;
    var $folder = 'auth';
    var $path = '';
    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->model = new User();
        $this->path = str_replace('.', '/', $this->folder);
    }

    public function login()
    {
        if (request()->isMethod('GET')) {

            return view('auth.login', [
                'jsControllers' => [
                    0 => 'app/' . $this->path . '/HomeController.js',
                ],
                'cssStyles' => [
                    0 => 'app/' . $this->path . '/style.css'
                ],
                'settings' => cache('settings'),
            ]);
        }

        auth()->attempt(request()->only('email', 'password'));

        if (!auth()->check()) {
            return $this->errorResponse([
                'err' => true,
                'message' => __('Wrong email or password')
            ]);
        }

        return $this->successResponse([
            'err'        => false,
            'message'    => __('Login success')
        ]);
    }



    private function lastAccess($user_id)
    {
        $user = User::find($user_id);
        $user->last_access = now();
        $user->save();
    }

    public function authenticated(Request $request, $user)
    {
        $user->last_access = now();
        $user->save();
    }

    public function register()
    {
        if (request()->getMethod() == 'GET') {
            return view('auth.register', [
                'jsControllers' => [
                    0 => 'app/' . $this->path . '/HomeController.js',
                ],
                'cssStyles' => [
                    0 => 'app/' . $this->path . '/style.css'
                ],
                'countries' => Country::get(['id', 'name'])
            ]);
        } else {
            try {
                DB::beginTransaction();
                $test = $this->model->create([
                    'avatar' => 'https://ui-avatars.com/api/?name=' . request()->get('name'),
                    'name' => request()->get('name'),
                    'lastname' => request()->get('lastname'),
                    'email' => request()->get('email'),
                    'password' => bcrypt(request()->get('password')),
                    'phone' => request()->get('phone'),
                    'country_id' => request()->get('country_id'),
                    'state_id' => request()->get('state_id'),
                    'city_id' => request()->get('city_id'),
                    'remember_token' => Str::random(10)
                ]);

                DB::commit();
                auth()->attempt(request()->only('email', 'password'));
                return $this->successResponse([
                    'err' => false,
                    'message' => __('Register success'),
                ]);
            } catch (\Exception $e) {
                DB::rollback();
                return $this->errorResponse([
                    'err' => true,
                    'message' => 'Problemas al registrar el usuario. Por favor intente de nuevo.',
                    'debug' => [
                        'file'     => $e->getFile(),
                        'line'     => $e->getLine(),
                        'message'  => $e->getMessage(),
                        'trace'    => $e->getTraceAsString()
                    ],
                ]);
            }
        }
    }


    public function forgot_password()
    {
        if (request()->method('GET')) {
            return view('auth.forgot_password', [
                'title' => '',
                'icon' => '',
                'settings' => cache('settings')
            ]);
        } else {
            $user = User::where('email', request()->get('email'))->first();
            if (!$user) {
                return $this->errorResponse([
                    'err' => true,
                    'message' => 'El correo electrónico no existe.'
                ]);
            }
            $user->password_reset_token = Str::random(60);
            $user->save();
            $this->send_password_reset_email($user);
            return $this->successResponse([
                'err' => false,
                'message' => 'Se ha enviado un correo electrónico con las instrucciones para restablecer su contraseña.'
            ]);
        }
    }

    public function reset_password()
    {
        if (request()->method('GET')) {
            if (request()->get('token')) {
                $user = User::where('password_reset_token', request()->get('token'))->first();
            }
            return view('auth.reset_password', [
                'settings' => cache('settings'),
                'user' => $user ?? null
            ]);
        } else {
            echo json_encode(request()->all());
        }
    }

    public function confirm($token)
    {
        $user = $this->model->where('remember_token', $token)->first();
        if ($user) {
            $user->email_verified_at = now();
            $user->save();
            return view('auth.success_confirm');
        } else {
            return view('auth.fail_confirm');
        }
    }



    public function logout()
    {
        if (auth()->check()) {
            auth('web')->logout();
        }
        return redirect()->route('login');
    }


    public function states($country)
    {
        $data['states'] = State::where("country_id", $country)->get(["id", "name"]);
        return response()->json($data);
    }

    public function cities($state)
    {
        $data['cities'] = City::where("state_id", $state)->get(["id", "name"]);
        return response()->json($data);
    }
}
