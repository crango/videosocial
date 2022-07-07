<?php

namespace App\Http\Controllers\Web\Settings;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Models\Channel;
use App\Models\Video;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    var $request;
    var $model;
    var $folder = 'web.account';
    var $path = '';


    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->model = new User();
        $this->path = str_replace('.', '/', $this->folder);
    }


    function index()
    {
        $channels = auth()->user()->Channels()->get();
        $videos = [];
        $subscriptions = 0;
        $key = 0;
        foreach ($channels as $channel) {
            if ($channel->Videos()->count() > 0) {
                $videos[$key] = $channel->Videos()->get();
                $subscriptions += $channel->subscriptions;
                $key++;
            }
        }


        $r = view($this->folder . '.index', [
            'jsControllers' => [
                0 => 'app/' . $this->path . '/controller.js'
            ],
            'cssStyles' => [
                //      0 => 'app/' . $this->path . '/style.css'
            ],

            'user' => auth()->user(),
            'videos' => $videos,
            'subscriptions' => $subscriptions,
            'channels' => auth()->user()->Channels()->get(),
            'allVideos' => Channel::all()->map(function ($item) {
                return $item->Videos()->where('user_id', auth()->user()->id)->get();
            })->flatten()->sortByDesc('created_at'),
        ]);

        dd($r);
    }
}
