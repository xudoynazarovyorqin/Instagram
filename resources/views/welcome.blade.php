@extends('layouts.home')
@section('content')
@foreach ($posts as $post)  
<div class="card shadow my-3 mx-auto" style="width: 90%">
        @foreach($post->user->profile as $profile)
            @if ($profile->user_id == $post->user_id)
                <div class="d-flex p-1">
                    <a href="profile/{{$profile->id}}" class="d-flex text-dark"><img src="{{$profile->photo}}" width="50px" height="50px" style="border-radius: 50%;" >
                        <h5 class="pl-2 my-auto">{{$post->user->username}}</h5></a>
                </div>
            @endif
        @endforeach
        <a href="/post/{{$post->id}}"><img class="card-img-top" src="{{$post->photo}}" width="60px"  alt="Card image cap"></a>
        <div class="card-body">
            <div class="d-flex">
                <?php $count = 0 ?>
                @foreach ($post->like as $like)
                    @if($like->user_id == Auth::user()->id && $post->id == $like->post_id)
                    <?php $count =1; ?>    
                    <a href="like/{{$post->id}}" class="text-danger"><i class="fas fa-heart fa-2x p-2"></i></a>
                    @endif
                @endforeach
                @if ($count != 1)
                    <a href="like/{{$post->id}}" class="text-dark"><i class="far fa-heart fa-2x p-2"></i></a>
                @endif
                <a href="post/{{$post->id}}" class="text-dark"><i class="far fa-comment fa-2x p-2"></i></a>
            </div>
            <b>{{count($post->like)}} like</b>
            <p class="card-text">{{$post->description}}</p><hr>
            @foreach ($post->comment->take(2) as $comment)
                <div class="d-inline">
                    <p><b>{{$comment->user->username}}: </b> {{$comment->comment}}</p>
                </div>
            @endforeach
            @if (Auth::check('login'))
            <form action="/comment" method="POST">
                @csrf
                <input type="hidden" name="post_id" value="{{$post->id}}">
                <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                
                <input type="text" name="comment" class=" comment border-0" placeholder="Add a comment ..." >
                <button type="submit" class="btn btn-post p-0 m-auto text-primary btn-none"><p><small>Post</small></p></button>
            </form>
            
                @endif
        </div>
    </div>
@endforeach
    
@endsection