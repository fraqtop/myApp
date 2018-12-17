@extends('layouts.admin')
@section('content')
    <img width="500px" height="500px" src="{{Request::user()->avatar ?? '/img/nothing.jpg'}}">
    <form action="" method="post" enctype="multipart/form-data">
        {{csrf_field()}}
        <input type="file"name="newAvatar" accept="image/*">
        <input type="submit" value="save" class="btn btn-primary">
    </form>
@endsection