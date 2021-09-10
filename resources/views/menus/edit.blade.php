@extends('layouts.master')
@section('content')
<h2>Edit Menu</h2>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form action="/menus/{{ $menu->id }}" method="POST" enctype="multipart/form-data">
    @method('PATCH')
    @csrf()
    <div class="row">
        <div class="col-md-6">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" id="name" placeholder="Enter name" value="{{ $menu->name }}">
        </div>
        <div class="col-md-6">
            <label for="price">Price</label>
            <input type="number" name="price" class="form-control" id="price" placeholder="0" value="{{ $menu->price }}" step="any" oninput="this.value = Math.max(this.value, 0)">
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <label for="description">Description</label>
            <input type="text" name="description" class="form-control" id="description" placeholder="Enter description" value="{{ $menu->description }}">
        </div>
        @if($menu->state)
            <div class="form-check form-check-inline">
            <input type="radio" class="form-check-input" id="state" name="state" value="1" checked>
            <label class="form-check-label" for="materialInline1">Active</label>
            </div>
            <div class="form-check form-check-inline">
            <input type="radio" class="form-check-input" id="state" name="state" value="0">
            <label class="form-check-label" for="materialInline2">Inactive</label>
            </div>
        @else
            <div class="form-check form-check-inline">
            <input type="radio" class="form-check-input" id="state" name="state" value="1">
            <label class="form-check-label" for="materialInline1">Active</label>
            </div>
            <div class="form-check form-check-inline">
            <input type="radio" class="form-check-input" id="state" name="state" value="0" checked>
            <label class="form-check-label" for="materialInline2">Inactive</label>
            </div>
        @endif
    </div>
    <br>
    <div class="form-group">
        <input class="btn btn-primary" type="submit" value="Edit">
        <a href="/menus" class="btn btn-primary">Cancel</a>
    </div>
</form>
@endsection