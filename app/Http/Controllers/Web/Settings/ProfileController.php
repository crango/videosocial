<?php

namespace App\Http\Controllers\Web\Settings;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Country;
use App\Models\State;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    var $request;
    var $model;
    var $folder = 'web.profile';
    var $path = '';

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->model = new User();
        $this->path = str_replace('.', '/', $this->folder);
    }

    function index()
    {
        return view($this->folder . '.index', [
            'jsControllers' => [
                0 => 'app/' . $this->path . '/controller.js'
            ],
            'cssStyles' => [
                //      0 => 'app/' . $this->path . '/style.css'
            ],
            'user' => auth()->user(),
            'countries' => Country::get(['id', 'name']),
            'states' => State::where('country_id', auth()->user()->country_id)->get(['id', 'name']),
            'cities' => City::where('state_id', auth()->user()->state_id)->get(['id', 'name'])
        ]);
    }

    public function update($id = null)
    {
        try {
            DB::beginTransaction();
            $data = $this->request->all();

            $itemData = $this->model->find(auth()->user()->id);

            if ($itemData && $data['password'] != '') {

                if (Hash::check($data['password'], \auth()->user()->password)) {
                    if ($data['newpassword'] != '') {
                        $data['password'] = bcrypt($data['newpassword']);
                    } else {
                        unset($data['password']);
                    }
                } else {
                    return $this->errorResponse([
                        'err' => true,
                        'message' => 'El password ingresado para actualizar los datos es incorrecto, por favor verifique e intente nuevamente.'
                    ]);
                }
                unset($data['avatar']);
                if (request()->hasFile('avatar')) {
                    $deleteFile = $itemData->avatar;
                    $data['avatar'] = request()->file('avatar')->storeAs('/users', time() . '.' . request()->file('avatar')->getClientOriginalExtension(), ['disk' => 'public']);
                    if ($deleteFile) {
                        Storage::disk('public')->delete($deleteFile);
                    }
                }
                if ($itemData->fill($data)->isDirty()) {
                    $itemData->save();
                    DB::commit();
                    return $this->successResponse([
                        'err' => false,
                        'message' => 'Datos actualizados correctamente.'
                    ]);
                } else {
                    return $this->successResponse([
                        'err' => false,
                        'message' => 'Ningún dato ha cambiado.'
                    ]);
                }
            } else {
                DB::rollback();
                return $this->errorResponse([
                    'err' => true,
                    'message' => 'El password actual, es requerido para actualizar los datos.'
                ]);
            }
        } catch (\Exception $e) {
            echo $e->getMessage();
            DB::rollback();
            return $this->errorResponse([
                'err' => true,
                'message' => 'No ha sido posible editar registro, por favor verifique su información e intente nuevamente.'
            ]);
        }
    }
}
