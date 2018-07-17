@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ $thread->title }}</div>
                    <div class="card-body">{{ $thread->body }}</div>
                </div>
            </div>
        </div>
        <br>
        <div class="row justify-content-center">
            <div class="col-md-8">
                @foreach($thread->replies as $reply)
                    <div class="card">
                        <div class="card-header">{{ $reply->created_at }}</div>
                        <div class="card-body">{{ $reply->body }}</div>
                    </div>
                    <br>
                @endforeach
            </div>

        </div>
    </div>


@endsection
