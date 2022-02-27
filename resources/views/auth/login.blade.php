@extends('layouts.auth')

@section('title')
Login
@endsection

@section('content')
<div class="row justify-content-center align-items-center h-80-vh">
    <div class="col-md-6">
        <form action="{{route('login')}}" method="POST">
            @csrf
            <div class="form-group py-2">
                <label>Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="form-group py-2">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <p class="text-center">
                <button class="btn btn-primary">Login</button>
            </p>
        </form>
    </div>
</div>
@endsection
