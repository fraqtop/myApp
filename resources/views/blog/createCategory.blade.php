@extends('layouts.app')
@section('content')
    <form method="post" class="admin-form" action="" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="form-group">
            <input type="text" class="form-control" name="categoryTitle" required>
        </div>
        <input name="categoryPicture" type="file" value="your file" required>
        <input class="btn btn-default" type="submit" value="save">
    </form>
@endsection