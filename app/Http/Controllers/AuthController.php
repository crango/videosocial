<?php

namespace App\Http\Controllers;

use App\Mail\SignUpMailable;

use App\Models\City;
use App\Models\Country;
use App\Models\State;
use App\Models\User;
use App\Models\UserVerify;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

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
                    0 => 'app/' . $this->path . '/controller.js',
                ],
                'cssStyles' => [
                    //    0 => 'app/' . $this->path . '/style.css'
                ],
                'title' => __('Welcome to Vidoe'),
                'description' => __('It is a long established fact that a reader') . "<br>" . __('will be distracted by the readable.')
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
            'message'    => __('Login success'),
            'url'      => route('web'),
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
        $request = request();
        if ($request->getMethod() == 'GET') {

            //  $correo = new SignUpMailable();
            // Mail::to(request()->get('email'))->send($correo);
            //Mail::to('crango.cero@gmail.com')->send($correo);
            // return $this->successResponse([
            //     'err' => false,
            //     'message' => 'Se ha enviado un correo a su cuenta de correo para que pueda confirmar su cuenta.',
            // ]);

            return view('auth.register', [
                'jsControllers' => [
                    0 => 'app/' . $this->path . '/controller.js',
                ],
                'cssStyles' => [
                    //0 => 'app/' . $this->path . '/style.css'
                ],
                'title' => __('Welcome to Vidoe'),
                'description' => __('It is a long established fact that a reader') . "<br>" . __('will be distracted by the readable.'),
                'countries' => Country::get(['id', 'name'])
            ]);
        } else {
            try {
                DB::beginTransaction();
                $user = $this->model->create([
                    'avatar' => 'https://ui-avatars.com/api/?name=' . $request->get('name'),
                    'name' => $request->get('name'),
                    'lastname' => $request->get('lastname'),
                    'email' => $request->get('email'),
                    'password' => bcrypt($request->get('password')),
                    'phone' => $request->get('phone'),
                    'country_id' => $request->get('country_id'),
                    'state_id' => $request->get('state_id'),
                    'city_id' => $request->get('city_id'),
                    'remember_token' => Str::random(10)
                ]);

                $token = Str::random(64);
                UserVerify::create([
                    'user_id' => $user->id,
                    'token' => $token
                ]);

                DB::commit();

                Mail::send('emails.verification-email', ['token' => $token], function ($message) use ($request) {
                    $message->to($request->email);
                    $message->subject('Email Verification Mail');
                });



                //    return redirect("dashboard")->withSuccess('Great! You have Successfully loggedin');


                // auth()->attempt(request()->only('email', 'password'));

                return $this->successResponse([
                    'err' => false,
                    //'message' => __('Register success'),
                    'message' => __('Great! You have Successfully loggedin'),
                    'url' => route('web')
                ]);
            } catch (\Exception $e) {
                DB::rollback();
                return $this->errorResponse([
                    'err' => true,
                    'message' => __('Register failed'),
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
                'jsControllers' => [
                    0 => 'app/' . $this->path . '/controller.js',
                ],
                'cssStyles' => [
                    //0 => 'app/' . $this->path . '/style.css'
                ],
                'title' => __('Reset Password'),
                'description' => __('It is a long established fact that a reader') . "\n" . __('will be distracted by the readable.')
            ]);
        } else {
            $user = User::where('email', request()->get('email'))->first();
            if (!$user) {
                return $this->errorResponse([
                    'err' => true,
                    'message' => __('There is no account associated with this email.')
                ]);
            }
            $user->password_reset_token = Str::random(60);
            $user->save();
            $this->send_password_reset_email($user);
            return $this->successResponse([
                'err' => false,
                'message' => __('An email has been sent with instructions to reset your password.')
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


    public function web()
    {
        if (auth()->check()) {
            return view('web', [
                'jsControllers' => [
                    0 => 'app/' . $this->path . '/controller.js',
                ],
                'cssStyles' => [
                    //0 => 'app/' . $this->path . '/style.css'
                ],
                'title' => __('Reset Password'),
                'description' => __('It is a long established fact that a reader') . "\n" . __('will be distracted by the readable.')
            ]);
        }


        return redirect("login")->withSuccess('Opps! You do not have access');
    }


    public function verifyAccount($token)
    {
        $verifyUser = UserVerify::where('token', $token)->first();

        if (!is_null($verifyUser)) {
            $user = $verifyUser->user;
            if (!$user->is_email_verified) {
                $verifyUser->user->is_email_verified = 1;
                $verifyUser->user->save();
                return $this->successResponse([
                    'err' => false,
                    'message' => __('Your e-mail is verified. You can now login.'),
                    'url' => route('login')
                ]);
            } else {
                return $this->successResponse([
                    'err' => false,
                    'message' => __('Your e-mail is already verified. You can now login'),
                    'url' => route('login')
                ]);
            }
        }
        return $this->successResponse([
            'err' => false,
            'message' => __('Sorry your email cannot be identified.'),
            'url' => route('login')
        ]);
    }
}
