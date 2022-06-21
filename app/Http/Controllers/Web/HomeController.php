<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    var $request;
    // var $model;
    var $folder = 'web';
    var $path;

    public function __construct(Request $request)
    {
        $this->request = $request;
        //  $this->model = new User();
        $this->path = str_replace('.', '/', $this->folder);
    }

    public function index()
    {
        return view($this->folder . '.index', [
            // 'jsControllers' => [
            //     0 => 'app/' . $this->path . '/controller.js',
            // ],
            // 'cssStyles' => [
            //     0 => 'app/' . $this->path . '/style.css'
            // ],
            'settings' => cache('settings'),
        ]);
    }
}
