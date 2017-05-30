@extends('layouts.basicLayout')
@section('content')
    <div class="panel-body" style="background: darkgrey">
        <form class="form-horizontal" method="post" action="">
            {{ csrf_field() }}
            <div class="form-group">
                <input name="title" class="col-md-8 col-md-offset-2"  type="text" placeholder="Title">
            </div>
            <div class="form-group">
                <textarea name="postContent" class="col-md-8 col-md-offset-2" cols="10" rows="10" placeholder="Content"></textarea>
            </div>
            <input type="submit" class="btn btn-default" value="Save">
        </form>
    </div>
@endsection