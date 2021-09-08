@extends('layouts.master')
@section('content')
<h2>User Create</h2>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form action="/users" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="row">
        <div class="col-md-6">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" id="name" placeholder="Enter name" value="{{ old('name') }}" required>
        </div>
        <div class="col-md-6">
            <label for="email">E-Mail</label>
            <input type="email" name="email" class="form-control" id="email" placeholder="Enter email" value="{{ old('email') }}">
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <label for="password">Password</label>
            <input type="password" name="password" class="form-control" id="password" placeholder="contraseña" required minlength="8">
        </div>
        <div class="col-md-6">
            <label for="password_confirmation">Confirm Password</label>
            <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" placeholder="Confirmar Contraseña">
        </div>
    </div>

    <div class="form-group pt-2">
        <input class="btn btn-success" type="submit" value="Ok">
        <a href="{{ url()->previous() }}" class="btn btn-success">Cancel</a>
    </div>
</form>
@endsection