@extends('layouts.app')
@section('content')
    <form method="post" action="" enctype="multipart/form-data">
        {{csrf_field()}}
        <input name="title">
        <input name="postContent">
        <input name="postPicture" type="file" value="your file">
        <input type="submit" value="GO!">
    </form>
@endsection