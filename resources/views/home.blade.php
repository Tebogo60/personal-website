<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tebogo Malebana | Home</title>
</head>
<body>
    <p style="color: green;">
        {{ session('message') }}
    </p>

    <h2>All Social Media Links</h2>

    @auth
        @if($socialMediaLinks->count() > 0)
            <table border="1" cellpadding="5" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Link Name</th>
                        <th>Link URL</th>
                        <th>Action</th>
                        <th>Action</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($socialMediaLinks as $link)
                    <tr>
                        <td>{{ $link->id }}</td>
                        <form action="/update-social-media-link/{{ $link->id }}" method="POST">
                            @csrf
                            @method('PUT')
                            <td><input type="text" name="link_name" value="{{ $link->link_name }}" required></td>
                            <td><input type="text" name="link_url" value="{{ $link->link_url }}" required></td>
                            <td>
                                <button type="submit">Update</button>
                            </td>
                        </form>
                        <td>
                            <form action="/delete-social-media-link/{{ $link->id }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button>Delete</button>
                        </form>
                        </td>
                        <td>{{ $link->created_at }}</td>
                        <td>{{ $link->updated_at }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>No links available.</p>
        @endif

        <p>Congrats {{ ucfirst(auth()->user()->name) }} you're logged in. 
            <form action="/logout" method="post">
                @csrf
                <button>Logout</button>
            </form>
        </p>

        <form action="/add-social-media-link" method="post">
            @csrf
            <input type="text" name="link_name" id="link_name" placeholder="Link Name" required>
            <input type="text" name="link_url" id="link_url" placeholder="Link URL" required>
            <button type="submit">Add Link</button>
        </form>
    @else
        <p>Please <a href="/login">login</a> or <a href="/register">register</a>.</p>
    @endauth    
</body>
</html>