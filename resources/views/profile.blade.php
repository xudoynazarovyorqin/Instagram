@extends('layouts.home')
@section('content')
    <div class="container " style="width: 70%">
        <div class="information  d-flex" style="border-bottom:1px solid #ababab">
    <div class="photo d-inline p-4 ml-3 pl-5">
                @foreach ($user->profile as $profile)
                    @if ($profile->user_id == $user->id)
                        <img src="{{$profile->photo}}" width="150px" height="150px" style="border-radius: 50%">
                    @endif
                @endforeach
            </div>
    <div class="info d-inline pt-4 pl-5 ml-3">
        <h4 class="py-1">{{$user->username}}</h4>
        <div class="d-flex">
            <p class="px-3 py-2"><b>{{count($user->post)}}</b> posts</p>
            <p class="px-3 py-2"><b>{{count($following)}}</b> follower</p>
            <p class="px-3 py-2"><b>{{count($follower)}}</b> following</p>
        </div>
       @foreach ($user->profile as $profile)
           @if ($profile->user_id == $user->id)
               
           <h5>{{$profile->fname}} {{$profile->lname}}</h5>
           @endif
       @endforeach
        <div class="d-flex">
            {{-- {{$follower}} --}}
            <form action="/follow" method="post">
                @csrf
                <input type="hidden" name="follower" value="{{Auth::user()->id}}">
                <input type="hidden" name="following" value="{{$user->id}}">
                {{-- {{$following}} --}}
                @if (count($following)==0)
                    <button type="submit" class="btn py-1 btn-primary" style="width: 100px">Follow</button>
                @else
                @foreach ($following as $flwing)
                {{-- {{$flwing}} --}}
                    @if ($flwing->follower_id== Auth::user()->id)
                        <button type="submit" class="btn py-1 btn-none" style="border: 1px solid #ababab;border-radius:5px;width: 100px">Following</button>
                    @else
                        <button type="submit" class="btn py-1 btn-primary" style="width: 100px">Follow</button>
                    @endif
                @endforeach
                @endif
                
            </form>
            <button class="btn ml-3 py-1 btn-none" style="border: 1px solid #ababab;border-radius:5px;width: 100px">Message</button>
        </div>
    </div>
    
   
</div>
<div class="posts">
    @foreach($user->post as $post)
            <a href="../post/{{$post->id}}"><img src="{{$post->photo}}" class=" post-photo py-1" width="32%" height="250px"></a>
            {{-- <span>{{count($post->like)}}</span> --}}
           
           
    @endforeach
</div>
    </div>
@endsection