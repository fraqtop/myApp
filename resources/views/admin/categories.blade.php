@extends('layouts.admin')
@section('content')
    @foreach($categories as $category)
        <form method="post" class="admin-form" style="padding: 10px; border-bottom: 1px solid grey"
              action="/admin/categories/{{ $category->id }}" enctype="multipart/form-data">
            {{ csrf_field() }}
            {{ method_field('patch') }}
            <div class="form-group">
                <input type="text" class="form-control" name="categoryTitle" value="{{ $category->title }}" required>
            </div>
            <input name="categoryPicture" type="file" value="your file">
            <input class="btn btn-dark" type="submit" value="edit">
        </form>
    @endforeach
    <form method="post" class="admin-form" action="" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group">
            <input type="text" class="form-control" name="categoryTitle" required>
        </div>
        <input name="categoryPicture" type="file" value="your file" required>
        <input class="btn btn-dark" type="submit" value="save">
    </form>
@endsection