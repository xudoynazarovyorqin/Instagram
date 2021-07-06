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
            <a href=""><img src="https://www.instagram.com/static/images/web/mobile_nav_type_logo.png/735145cfe0a4.png" alt=""></a>
        </div>
    </nav>

    <div class="container " style="width: 40%">
        
        <form action="/add-info" method="POST">
            @csrf
            <span>Photo url</span>
            <input type="text" class="form-control my-2 " name="photo">

            <span>Firstname</span>
            <input type="text" class="form-control my-2 " name="fname">

            <span>Lastname</span>
            <input type="text" class="form-control my-2 " name="lname">

            <input type="hidden" name="id" value="{{Auth::user()->id}}">
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
        
    </div>


    </div>
</body>
</html>