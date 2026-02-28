<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tebogo Malebana | Register</title>
</head>
<body>
    <form action="/user-register" method="post" style="display: flex; flex-direction: column; gap: 10px; width: 300px; margin-left: auto; margin-right: auto; padding: 50px; border: 1px solid gray;">
        @csrf
        <input type="text" name="name" id="name" placeholder="Name" required>
        <input type="email" name="email" id="email" placeholder="Email" required>
        <input type="tel" name="phone" id="phone" placeholder="phone">
        <input type="text" name="linkedin" id="linkedin" placeholder="LinkedIn">
        <input type="text" name="github" id="github" placeholder="GitHub">
        <input type="password" name="password" id="password" placeholder="Password" required>
        <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirm Password" required>
        <button type="submit">Register</button>
    </form>
</body>
</html>