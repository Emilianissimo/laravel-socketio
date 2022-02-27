@extends('layouts.layout')

@section('title')
Chats
@endsection

@section('content')
<div class="row justify-content-center align-items-center my-2">
    <div class="col-md-7">
        <form action="{{route('chats.store')}}" method="POST">
            @csrf
            <div>
                <button class="btn btn-success w-100">Start chat</button>
            </div>
            <div class="form-group py-2">
                <select name="reciever_id" class="select2 form-control" id="">
                    @foreach($users as $user)
                        <option value="{{$user->id}}">{{$user->name}}</option>
                    @endforeach
                </select>
            </div>
        </form>
    </div>
    <div class="col-md-7 my-3">
        @foreach($chats as $chat)
        <a href="{{route('chats.show', $chat->id)}}" class="text-dark text-decoration-none">
            <div class="shadow p-3 mb-5 bg-white rounded">
                <div class="row">
                    <div class="col-md-7 col-7">
                        {{$chat->getCompanionName()}}
                    </div>
                    <div class="col-md-5 col-5">
                        Started at: {{$chat->created_at->format('d F, Y')}}
                    </div>
                </div>
            </div>
        </a>
        @endforeach
    </div>
</div>
@endsection
