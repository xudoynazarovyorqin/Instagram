@extends('layouts.home')
@section('content')

    <a href="/" type="submit" class="btn btn-none my-2">back</a>
    <div class="d-flex">
        <div class="d-inline" >
            <img src="{{$post->photo}}" width="50%" alt="">
        </div>
        <div class="d-inline ">
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