<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('Assets/css/style.css') }}">

    <title>Document</title>
</head>
<body>
    @foreach ($notes as $note)
    <div class="container">
        <div class="wrapper">
            <div class="banner-image">
                <img src="{{asset($note->images)}}" alt="" >
            </div>
            <h1> {{ $note->title}}</h1>
            <p>{{ $note->body}}</p>
            </div>
            <div class="button-wrapper"> 
            </div>
        </div>
    </div>
        @endforeach
    
</body>
</html>