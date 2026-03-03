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

    @auth
        <!-- Social Media Links -->
        <h2>All Social Media Links</h2>
        @if($socialMediaLinks->count() > 0)
            <table border="1" cellpadding="5" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Link Name</th>
                        <th>Link URL</th>
                        <th>Update</th>
                        <th>Delete</th>
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
                            <td><button type="submit">Update</button></td>
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

            <form action="/add-social-media-link" method="post">
                @csrf
                <input type="text" name="link_name" placeholder="Link Name" required>
                <input type="text" name="link_url" placeholder="Link URL" required>
                <button type="submit">Add Link</button>
            </form>
        @else
            <p>No social media links available.</p>
        @endif

        <!-- Page Summary -->
        <h2>Page Summaries</h2>
        @if($pageSummaries && $pageSummaries->count() > 0)
            <table border="1" cellpadding="5" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Muted Text</th>
                        <th>Title</th>
                        <th>Sub Title</th>
                        <th>Update</th>
                        <th>Delete</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pageSummaries as $summary)
                    <tr>
                        <td>{{ $summary->id }}</td>
                        <form action="/update-page-summary/{{ $summary->id }}" method="POST">
                            @csrf
                            @method('PUT')
                            <td><input type="text" name="muted_text" value="{{ $summary->muted_text }}"></td>
                            <td><input type="text" name="title" value="{{ $summary->title }}" required></td>
                            <td><input type="text" name="sub_title" value="{{ $summary->sub_title }}"></td>
                            <td><button type="submit">Update</button></td>
                        </form>
                        <td>
                            <form action="/delete-page-summary/{{ $summary->id }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button>Delete</button>
                            </form>
                        </td>
                        <td>{{ $summary->created_at }}</td>
                        <td>{{ $summary->updated_at }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>No page summaries available.</p>
        @endif

        <form action="/add-page-summary" method="POST">
            @csrf
            <input type="text" name="muted_text" placeholder="Muted Text">
            <input type="text" name="title" placeholder="Title" required>
            <input type="text" name="sub_title" placeholder="Sub Title">
            <button type="submit">Add Page Summary</button>
        </form>

        <!-- Logout -->
        <p>Congrats {{ ucfirst(auth()->user()->name) }} you're logged in. 
            <form action="/logout" method="POST">
                @csrf
                <button>Logout</button>
            </form>
        </p>

    @else
        <p>Please <a href="/login">login</a> or <a href="/register">register</a>.</p>
    @endauth    
</body>
</html>