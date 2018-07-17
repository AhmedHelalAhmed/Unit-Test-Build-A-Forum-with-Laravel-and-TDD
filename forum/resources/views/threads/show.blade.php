@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <a href="#">{{ $thread->creatorName() }}</a> posted:
                        {{ $thread->title }}
                    </div>
                    <div class="card-body">{{ $thread->body }}</div>
                </div>
            </div>
        </div>
        <br>
        <div class="row justify-content-center">
            <div class="col-md-8">
                @foreach($thread->replies as $reply)
                    @include('threads.reply')
                @endforeach
            </div>

        </div>

        @if(auth()->check())

            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            add reply
                        </div>
                        <div class="card-body">hello</div>
                    </div>
                </div>
            </div>
        @endif


    </div>


@endsection
