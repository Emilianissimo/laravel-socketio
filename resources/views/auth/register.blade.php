@extends('layouts.auth')

@section('title')
Register
@endsection

@section('content')
<div class="row justify-content-center align-items-center h-80-vh">
    <div class="col-md-6">
        <form action="{{route('register')}}" method="POST">
            @csrf
            <div class="form-group py-2">
                <label>Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="form-group py-2">
                <label>Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="form-group py-2">
                <label>Password</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
            </div>

            <div class="form-group py-2">
                <label>Confirm</label>
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
            </div>
            <p class="text-center">
                <button class="btn btn-primary">Register</button>
            </p>
        </form>
    </div>
</div>
@endsection
