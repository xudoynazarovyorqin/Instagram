@extends('layouts.home')
@section('content')

    <a href="/" type="submit" class="btn btn-none my-2">back</a>
    <div class="d-flex">
        <div class="d-inline" style="width: 60%">
            <img src="{{$post->photo}}" width="100%" alt="">
            <?php $count = 0 ?>
                @foreach ($post->like as $like)
                    @if($like->user_id == Auth::user()->id && $post->id == $like->post_id)
                    <?php $count =1; ?>    
                    <a href="../like/{{$post->id}}" class="text-danger"><i class="fas fa-heart fa-2x p-2"></i></a>
                    @endif
                @endforeach
                @if ($count != 1)
                    <a href="../like/{{$post->id}}" class="text-dark"><i class="far fa-heart fa-2x p-2"></i></a>
                @endif
                <a href="post/{{$post->id}}" class="text-dark"><i class="far fa-comment fa-2x p-2"></i></a>
            <b style="display: block">{{count($post->like)}} like</b>

            <p>{{$post->description}}</p>
        </div>
        <div class="d-inline " style="margin-left: 4rem">
            <div class="comments">
                @foreach ($comments as $comment)
                    @foreach ($comment->user->profile as $item)
                        <a href="" class="d-flex text-dark ">
                            <img src="{{$item->photo}}" width="20px" height="20px" style="border-radius: 50%">
                            <h5 class="px-2">{{$comment->user->username}}</h5>
                        </a>
                        <p style="border-bottom:0.5px solid #ababab">{{$comment->comment}}</p>
                    @endforeach
                @endforeach
                </div>
            <form action="/comment" method="POST">
                @csrf
                <input type="hidden" name="post_id" value="{{$post->id}}">
                <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                <input type="text" name="comment" class=" comment border-0" placeholder="Add a comment ..." >
                <button type="submit" class="btn btn-post p-0 m-auto text-primary btn-none"><p><small>Post</small></p></button>
            </form>
            
        </div>
    </div>

@endsection