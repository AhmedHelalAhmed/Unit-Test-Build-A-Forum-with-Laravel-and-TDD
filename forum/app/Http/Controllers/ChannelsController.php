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
    public function show($channelSlug)
    {
        $channelId = Channel::where('slug',$channelSlug)->first()->id;


        $threads= Thread::where('channel_id', $channelId)->latest()->get();

        return view('threads.index',['threads'=>$threads]);
    }
}
