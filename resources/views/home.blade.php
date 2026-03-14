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

    <!-- Page Summary Links -->
    <h2>Page Summary Links</h2>
    @if($pageSummaryLinks->count() > 0)
        <table border="1" cellpadding="5" cellspacing="0">
            <thead>
            <tr>
                <th>ID</th>
                <th>Page Summary ID</th>
                <th>Link Name</th>
                <th>Link Type</th>
                <th>Link URL</th>
                <th>Update</th>
                <th>Delete</th>
                <th>Created At</th>
                <th>Updated At</th>
            </tr>
            </thead>
            <tbody>
            @foreach($pageSummaryLinks as $link)
                <tr>
                    <td>{{ $link->id }}</td>
                    <td>{{ $link->page_summary_id }}</td>
                    <form action="/update-page-summary-link/{{ $link->id }}" method="POST">
                        @csrf
                        @method('PUT')
                        <td><input type="text" name="link_name" value="{{ $link->link_name }}" required></td>
                        <td><input type="text" name="link_type" value="{{ $link->link_type }}" required></td>
                        <td><input type="text" name="link_url" value="{{ $link->link_url }}" required></td>
                        <td><button type="submit">Update</button></td>
                    </form>
                    <td>
                        <form action="/delete-page-summary-link/{{ $link->id }}" method="POST">
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

        <h3>Add Page Summary Link</h3>
        <form action="/add-page-summary-link" method="POST">
            @csrf
            <select name="page_summary_id" required>
                <option value="">Select Page Summary</option>
                @foreach($pageSummaries as $summary)
                    <option value="{{ $summary->id }}">{{ $summary->title }}</option>
                @endforeach
            </select>
            <input type="text" name="link_name" placeholder="Link Name" required>
            <input type="text" name="link_type" placeholder="Link Type" required>
            <input type="text" name="link_url" placeholder="Link URL" required>
            <button type="submit">Add Page Summary Link</button>
        </form>
    @else
        <p>No page summary links available.</p>

        <h3>Add Page Summary Link</h3>
        <form action="/add-page-summary-link" method="POST">
            @csrf
            <select name="page_summary_id" required>
                <option value="">Select Page Summary</option>
                @foreach($pageSummaries as $summary)
                    <option value="{{ $summary->id }}">{{ $summary->title }}</option>
                @endforeach
            </select>
            <input type="text" name="link_name" placeholder="Link Name" required>
            <input type="text" name="link_type" placeholder="Link Type" required>
            <input type="text" name="link_url" placeholder="Link URL" required>
            <button type="submit">Add Page Summary Link</button>
        </form>
    @endif

    <!-- About Users -->
    <h2>About Users</h2>
    @if($aboutUsers->count() > 0)
        <table border="1" cellpadding="5" cellspacing="0">
            <thead>
            <tr>
                <th>ID</th>
                <th>Summary</th>
                <th>Update</th>
                <th>Delete</th>
                <th>Created At</th>
                <th>Updated At</th>
            </tr>
            </thead>
            <tbody>
            @foreach($aboutUsers as $aboutUser)
                <tr>
                    <td>{{ $aboutUser->id }}</td>
                    <form action="/update-about-user/{{ $aboutUser->id }}" method="POST">
                        @csrf
                        @method('PUT')
                        <td><input type="text" name="summary" value="{{ $aboutUser->summary }}" required></td>
                        <td><button type="submit">Update</button></td>
                    </form>
                    <td>
                        <form action="/delete-about-user/{{ $aboutUser->id }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button>Delete</button>
                        </form>
                    </td>
                    <td>{{ $aboutUser->created_at }}</td>
                    <td>{{ $aboutUser->updated_at }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <form action="/add-about-user" method="POST">
            @csrf
            <input type="text" name="summary" placeholder="Summary" required>
            <button type="submit">Add About User</button>
        </form>
    @else
        <p>No about user records available.</p>

        <form action="/add-about-user" method="POST">
            @csrf
            <input type="text" name="summary" placeholder="Summary" required>
            <button type="submit">Add About User</button>
        </form>
    @endif

    <!-- About Links -->
    <h2>About Links</h2>
    @if($aboutLinks->count() > 0)
        <table border="1" cellpadding="5" cellspacing="0">
            <thead>
            <tr>
                <th>ID</th>
                <th>About User ID</th>
                <th>Link Name</th>
                <th>Link Icon</th>
                <th>Link Type</th>
                <th>Link URL</th>
                <th>Update</th>
                <th>Delete</th>
                <th>Created At</th>
                <th>Updated At</th>
            </tr>
            </thead>
            <tbody>
            @foreach($aboutLinks as $link)
                <tr>
                    <td>{{ $link->id }}</td>
                    <td>{{ $link->about_user_id }}</td>
                    <form action="/update-about-link/{{ $link->id }}" method="POST">
                        @csrf
                        @method('PUT')
                        <td><input type="text" name="link_name" value="{{ $link->link_name }}" required></td>
                        <td><input type="text" name="link_icon" value="{{ $link->link_icon }}"></td>
                        <td><input type="text" name="link_type" value="{{ $link->link_type }}" required></td>
                        <td><input type="text" name="link_url" value="{{ $link->link_url }}" required></td>
                        <td><button type="submit">Update</button></td>
                    </form>
                    <td>
                        <form action="/delete-about-link/{{ $link->id }}" method="POST">
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

        <form action="/add-about-link" method="POST">
            @csrf
            <select name="about_user_id" required>
                <option value="">Select About User</option>
                @foreach($aboutUsers as $aboutUser)
                    <option value="{{ $aboutUser->id }}">{{ $aboutUser->id }}</option>
                @endforeach
            </select>
            <input type="text" name="link_name" placeholder="Link Name" required>
            <input type="text" name="link_icon" placeholder="Link Icon">
            <input type="text" name="link_type" placeholder="Link Type" required>
            <input type="text" name="link_url" placeholder="Link URL" required>
            <button type="submit">Add About Link</button>
        </form>
    @else
        <p>No about links available.</p>

        <form action="/add-about-link" method="POST">
            @csrf
            <select name="about_user_id" required>
                <option value="">Select About User</option>
                @foreach($aboutUsers as $aboutUser)
                    <option value="{{ $aboutUser->id }}">{{ $aboutUser->id }}</option>
                @endforeach
            </select>
            <input type="text" name="link_name" placeholder="Link Name" required>
            <input type="text" name="link_icon" placeholder="Link Icon">
            <input type="text" name="link_type" placeholder="Link Type" required>
            <input type="text" name="link_url" placeholder="Link URL" required>
            <button type="submit">Add About Link</button>
        </form>
    @endif

    <!-- Experiences -->
    <h2>Experiences</h2>
    @if($experiences->count() > 0)
        <table border="1" cellpadding="5" cellspacing="0">
            <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Summary</th>
                <th>Update</th>
                <th>Delete</th>
                <th>Created At</th>
                <th>Updated At</th>
            </tr>
            </thead>
            <tbody>
            @foreach($experiences as $experience)
                <tr>
                    <td>{{ $experience->id }}</td>
                    <form action="/update-experience/{{ $experience->id }}" method="POST">
                        @csrf
                        @method('PUT')
                        <td><input type="text" name="title" value="{{ $experience->title }}" required></td>
                        <td><input type="date" name="start_date" value="{{ $experience->start_date }}" required></td>
                        <td><input type="date" name="end_date" value="{{ $experience->end_date }}"></td>
                        <td><input type="text" name="summary" value="{{ $experience->summary }}" required></td>
                        <td><button type="submit">Update</button></td>
                    </form>
                    <td>
                        <form action="/delete-experience/{{ $experience->id }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button>Delete</button>
                        </form>
                    </td>
                    <td>{{ $experience->created_at }}</td>
                    <td>{{ $experience->updated_at }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <form action="/add-experience" method="POST">
            @csrf
            <input type="text" name="title" placeholder="Title" required>
            <input type="date" name="start_date" required>
            <input type="date" name="end_date">
            <input type="text" name="summary" placeholder="Summary" required>
            <button type="submit">Add Experience</button>
        </form>
    @else
        <p>No experiences available.</p>

        <form action="/add-experience" method="POST">
            @csrf
            <input type="text" name="title" placeholder="Title" required>
            <input type="date" name="start_date" required>
            <input type="date" name="end_date">
            <input type="text" name="summary" placeholder="Summary" required>
            <button type="submit">Add Experience</button>
        </form>
    @endif

    <!-- Experience Languages -->
    <h2>Experience Languages</h2>
    @if($experienceLanguages->count() > 0)
        <table border="1" cellpadding="5" cellspacing="0">
            <thead>
            <tr>
                <th>ID</th>
                <th>Experience ID</th>
                <th>Language Name</th>
                <th>Update</th>
                <th>Delete</th>
                <th>Created At</th>
                <th>Updated At</th>
            </tr>
            </thead>
            <tbody>
            @foreach($experienceLanguages as $language)
                <tr>
                    <td>{{ $language->id }}</td>
                    <td>{{ $language->experience_id }}</td>
                    <form action="/update-experience-language/{{ $language->id }}" method="POST">
                        @csrf
                        @method('PUT')
                        <td><input type="text" name="language_name" value="{{ $language->language_name }}" required></td>
                        <td><button type="submit">Update</button></td>
                    </form>
                    <td>
                        <form action="/delete-experience-language/{{ $language->id }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button>Delete</button>
                        </form>
                    </td>
                    <td>{{ $language->created_at }}</td>
                    <td>{{ $language->updated_at }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <form action="/add-experience-language" method="POST">
            @csrf
            <select name="experience_id" required>
                <option value="">Select Experience</option>
                @foreach($experiences as $experience)
                    <option value="{{ $experience->id }}">{{ $experience->title }}</option>
                @endforeach
            </select>
            <input type="text" name="language_name" placeholder="Language Name" required>
            <button type="submit">Add Experience Language</button>
        </form>
    @else
        <p>No experience languages available.</p>

        <form action="/add-experience-language" method="POST">
            @csrf
            <select name="experience_id" required>
                <option value="">Select Experience</option>
                @foreach($experiences as $experience)
                    <option value="{{ $experience->id }}">{{ $experience->title }}</option>
                @endforeach
            </select>
            <input type="text" name="language_name" placeholder="Language Name" required>
            <button type="submit">Add Experience Language</button>
        </form>
    @endif

    <!-- Projects -->
    <h2>Projects</h2>
    @if($projects->count() > 0)
        <table border="1" cellpadding="5" cellspacing="0">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Cover Image</th>
                <th>Summary</th>
                <th>Project URL</th>
                <th>Update</th>
                <th>Delete</th>
                <th>Created At</th>
                <th>Updated At</th>
            </tr>
            </thead>
            <tbody>
            @foreach($projects as $project)
                <tr>
                    <td>{{ $project->id }}</td>
                    <form action="/update-project/{{ $project->id }}" method="POST">
                        @csrf
                        @method('PUT')
                        <td><input type="text" name="name" value="{{ $project->name }}" required></td>
                        <td><input type="text" name="cover_img" value="{{ $project->cover_img }}"></td>
                        <td><input type="text" name="summary" value="{{ $project->summary }}" required></td>
                        <td><input type="text" name="project_url" value="{{ $project->project_url }}"></td>
                        <td><button type="submit">Update</button></td>
                    </form>
                    <td>
                        <form action="/delete-project/{{ $project->id }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button>Delete</button>
                        </form>
                    </td>
                    <td>{{ $project->created_at }}</td>
                    <td>{{ $project->updated_at }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <form action="/add-project" method="POST">
            @csrf
            <input type="text" name="name" placeholder="Project Name" required>
            <input type="text" name="cover_img" placeholder="Cover Image">
            <input type="text" name="summary" placeholder="Summary" required>
            <input type="text" name="project_url" placeholder="Project URL">
            <button type="submit">Add Project</button>
        </form>
    @else
        <p>No projects available.</p>

        <form action="/add-project" method="POST">
            @csrf
            <input type="text" name="name" placeholder="Project Name" required>
            <input type="text" name="cover_img" placeholder="Cover Image">
            <input type="text" name="summary" placeholder="Summary" required>
            <input type="text" name="project_url" placeholder="Project URL">
            <button type="submit">Add Project</button>
        </form>
    @endif

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
