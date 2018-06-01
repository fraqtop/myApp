@extends('layouts.app')
@section('content')
    <form class="admin-form" method="post" action="" enctype="multipart/form-data">
        {{csrf_field()}}
        @if(isset($post))
            {{
                method_field('patch'),
                $postTitle = $post->title,
                $postContent = $post->content,
                $postCategory = $post->category_id
            }}
        @endif
        <div class="form-group">
            <input class="form-control" type="text" value="{{ $postTitle or '' }}" name="postTitle" required>
        </div>
        <div class="form-group">
            <textarea rows="7" class="form-control" name="postContent" required>{{ $postContent or '' }}</textarea>
        </div>
        <div class="form-group">
            <select class="form-control" name="postCategory">
                @foreach($categories as $category)
                        <option @if(isset($postCategory))
                                <?php echo $category->id != $postCategory ?: 'selected'?>
                                @endif
                                value="{{$category->id}}">{{$category->title}}</option>
                @endforeach
            </select>
        </div>
        <input name="postPicture" type="file" value="your file">
        <input class="btn btn-default" type="submit" value="save">
    </form>
@endsection