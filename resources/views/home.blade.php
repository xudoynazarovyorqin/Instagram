<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
    integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w=="
    crossorigin="anonymous" />
    <title>Instagram</title>
</head>
<body >
    <nav class="navbar bg-light mb-1 rounded fixed-top navbar-light" style="position: relative;border-bottom:1px solid #ababab;">
        <div class="container py-2" style="width: 70%">
            <a href="/"><img src="https://www.instagram.com/static/images/web/mobile_nav_type_logo.png/735145cfe0a4.png" alt=""></a>
            <form action="/logout" method="POST">
                @csrf
                <button class="btn btn-none" type="submit">logout</button>
            </form>
        </div>
    </nav>

    <div class="container " style="width: 65%">
        <div class="information  d-flex" style="border-bottom:1px solid #ababab">
            <div class="photo d-inline p-4 ml-3 pl-5">
                @foreach (Auth::user()->profile as $item)
                    @if ($item->user_id == Auth::user()->id)
                        @if (isset($item->photo))
                            {{-- <img src="https://icon-library.com/images/no-user-image-icon/no-user-image-icon-14.jpg" width="150px" height="150px" style="border-radius: 50%"> --}}
                        @else
                        @endif
                        <img src="{{$item->photo}}" width="150px" height="150px" style="border-radius: 50%">
                    @endif
                @endforeach
                    </div>
            <div class="info d-inline pt-4 pl-5 ml-3">
                <h4 class="py-1">{{Auth::user()->username}}</h4>
                <div class="d-flex">
                    <p class="px-3 py-2"><b>{{count(Auth::user()->post)}}</b> posts</p>
                    <p class="px-3 py-2"><b>{{count($following)}}</b> follower</p>
                    <p class="px-3 py-2"><b>{{count($follower)}}</b> following</p>
                </div>
                @foreach (Auth::user()->profile as $item)
                    @if ($item->user_id == Auth::user()->id)
                        <h5>{{$item->fname}} {{$item->lname}}</h5>
                    @endif
                @endforeach
                <a href="add-post" class="text-center text-dark"><i class="fas fa-plus-circle"></i></a> 
            </div>
            <div class="update pt-4 ">
                <a href="/add-info" class="text-dark"><i class="fas fa-cog fa-lg"></i></a>
            </div>
           
        </div>
        <div class="posts m-auto" >
            @foreach(Auth::user()->post as $post)
                    <a href="post/{{$post->id}}"><img src="{{$post->photo}}" class=" post-photo py-1" width="32%" height="250px"></a>

            @endforeach
        </div>
    </div>
</body>
</html>