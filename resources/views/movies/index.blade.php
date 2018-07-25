<!DOCTYPE html>
<html>
    <head>
        <title>Laravel movie</title>



    </head>
    <body>
        <div class="container">
            <div class="content">
                <div class="title">Laravel 5</div>
            </div>
        </div>
        <ul>
            @foreach($movies as movie)
             <li>{{$movies->movie_title}}</li>>
             @endforeach 
        </ul>
    </body>
</html>
