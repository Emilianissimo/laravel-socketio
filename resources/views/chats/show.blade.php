@extends('layouts.layout')

@section('title')
Chat with: {{$chat->getCompanionName()}}
@endsection

@section('content')
<div class="row justify-content-center align-items-center my-2">
    <div class="col-md-7">
        <h1 class="text-center">
            Chat with: <span data-id="{{$chat->getCompanionID()}}" id="companion-id">{{$chat->getCompanionName()}}</span>
        </h1>
        <form action="{{route('messages.store', $chat->id)}}" method="POST">
            @csrf
            <div>
                <button class="btn btn-success w-100">Send</button>
            </div>
            <div class="form-group py-2">
                <input type="text" name="message" class="form-control">
            </div>
        </form>
    </div>
    <div class="col-md-7 my-3" id="messages">
        @foreach($messages as $message)
        @if($message->user->id == Auth::user()->id)
        <div class="row">
            <div class="col-md-3 col-3"></div>
            <div class="col-md-9 col-9">
                <div class="shadow p-3 mb-5 bg-white rounded">
                    <div class="row">
                        <div class="col-md-8 col-8">
                            <h6>{{$message->user->name}}</h6>
                        </div>
                        <div class="col-md-4 col-4">
                            <h6 style="text-align:right">{{$message->created_at->format('d F, Y')}}</h6>
                        </div>
                    </div>
                    <p>{{$message->getMessage()}}</p>
                </div>
            </div>
        </div>
        @else
        <div class="row">
            <div class="col-md-9 col-9">
                <div class="shadow p-3 mb-5 bg-white rounded">
                    <div class="row">
                        <div class="col-md-8 col-8">
                            <h6>{{$message->user->name}}</h6>
                        </div>
                        <div class="col-md-4 col-4">
                            <h6 style="text-align:right">{{$message->created_at->format('d F, Y')}}</h6>
                        </div>
                    </div>
                    <p>{{$message->getMessage()}}</p>
                </div>
            </div>
            <div class="col-md-3 col-3"></div>
        </div>
        @endif
        @endforeach
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.socket.io/4.4.1/socket.io.min.js" integrity="sha384-fKnu0iswBIqkjxrhQCTZ7qlLHOFEgNkRmK2vaO/LbTZSXdJfAu6ewRBdwHPhBo/H" crossorigin="anonymous"></script>
<script src="{{asset('js/socket.js')}}"></script>
@endsection