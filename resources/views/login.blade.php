<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tebogo Malebana | Login</title>
</head>
<body>
    <form action="/user-login" method="post" style="display: flex; flex-direction: column; gap: 10px; width: 300px; margin-left: auto; margin-right: auto; padding: 50px; border: 1px solid gray;">
        @csrf
        @error('email')
            <p style="color: red;">{{ $message }}</p>
        @enderror
        <input type="email" name="email" id="email" placeholder="Email" value="{{ old('email') }}" required>
        <input type="password" name="password" id="password" placeholder="Password" required>
        <button type="submit">Login</button>
    </form>
</body>
</html>