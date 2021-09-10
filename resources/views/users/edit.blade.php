@extends('layouts.master')
@section('content')
<h2>Edit User</h2>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form action="/users/{{ $user->id }}" method="POST" enctype="multipart/form-data">
    @method('PATCH')
    @csrf()
    <div class="row">
        <div class="col-md-6">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" id="name" placeholder="Enter name" value="{{ $user->name}}">
        </div>
        <div class="col-md-6">
            <label for="email">E-Mail</label>
            <input type="text" name="email" class="form-control" id="email" placeholder="Enter email" value="{{ $user->email }}">
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <label for="password">Password</label>
            <input type="password" name="password" class="form-control" id="password" placeholder="contraseña" minlength="8">
        </div>
        <div class="col-md-6">
            <label for="password_confirmation">Confirm Password</label>
            <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" placeholder="Confirmar Contraseña">
        </div>
    </div>
    <br>
    <div class="form-group">
        <input class="btn btn-primary" type="submit" value="Edit">
        <a href="{{ url()->previous() }}" class="btn btn-primary">Cancel</a>
    </div>
</form>
@endsection