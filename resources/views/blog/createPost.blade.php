@extends('layouts.app')
@section('content')
    <form method="post" action="" enctype="multipart/form-data">
        {{csrf_field()}}
        <input name="postTitle">
        <input name="postContent">
        <select name="postCategory">
            @foreach($categories as $category)
                <option value="{{$category->id}}">{{$category->title}}</option>
            @endforeach
        </select>
        <input name="postPicture" type="file" value="your file">
        <input type="submit" value="GO!">
    </form>
@endsection