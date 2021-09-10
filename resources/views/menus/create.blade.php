@extends('layouts.master')
@section('content')
<h3>Menu Create</h3>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form action="/menus" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="row">
        <div class="col-md-6">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" id="name" placeholder="Enter name" value="{{ old('name') }}" required>
        </div>
        <div class="col-md-6">
            <label for="price">Price</label>
            <input type="number" name="price" class="form-control" id="price" placeholder="Enter price" value="{{ old('price') }}" step="any" oninput="this.value = Math.max(this.value, 0)" required>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <label for="description">Description</label>
            <input type="text" name="description" class="form-control" id="description" placeholder="Enter description" value="{{ old('description') }}" required>
        </div>
        <div class="col-md-6">
            <label for="state">State</label>
            <div class="form-check form-check-inline">
                <input type="radio" class="form-check-input" id="state" name="state" value="1" checked>
                <label class="form-check-label" for="materialInline1">Active</label>
            </div>
            <div class="form-check form-check-inline">
                <input type="radio" class="form-check-input" id="state" name="state" value="0">
                <label class="form-check-label" for="materialInline2">Inactive</label>
            </div>
        </div>
    </div>
    <div class="form-group pt-2">
        <input class="btn btn-primary" type="submit" value="Ok">
        <a href="/menus" class="btn btn-primary">Cancel</a>
    </div>
</form>
@endsection