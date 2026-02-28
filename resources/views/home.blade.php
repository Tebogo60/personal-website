<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tebogo Malebana | Home</title>
</head>
<body>
    @auth
        <p>Congrats {{ ucfirst(auth()->user()->name) }} you're logged in. 
            <form action="/logout" method="post">
                @csrf
                <button>Logout</button>
            </form>
        </p>
    @else
        <p>Please <a href="/login">login</a> or <a href="/register">register</a>.</p>
    @endauth    
</body>
</html>