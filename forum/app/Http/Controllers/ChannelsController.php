<?php

namespace App\Http\Controllers;

use App\Channel;
use App\Thread;
use Illuminate\Http\Request;

class ChannelsController extends Controller
{
    /**
     * @param $channelSlug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Channel $channel)
    {




        if($channel->exists)
        {
            $threads = $channel->threads()->latest()->get();
        }


        return view('threads.index',compact('threads'));
    }
}
