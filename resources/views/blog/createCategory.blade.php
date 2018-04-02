@extends('layouts.app')
@section('content')
    <form method="post" action="" enctype="multipart/form-data">
        {{csrf_field()}}
        <input name="categoryTitle">
        <input name="categoryPicture" type="file" value="your file">
        <input type="submit" value="GO!">
    </form>
@endsection