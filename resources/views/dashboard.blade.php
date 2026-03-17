<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tebogo Malebana | Dashboard</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">

    <!-- Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet"
    />

    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
</head>
<body>

@auth
    <div class="dash-wrap">

        <!-- TOPBAR -->
        <header class="topbar">
            <div class="topbar-brand">
                <div class="brand-mark"></div>
                <span class="brand-name">Dashboard</span>
            </div>

            <div class="topbar-right">
                @if(session('message'))
                    <div class="flash-msg">{{ session('message') }}</div>
                @endif
                <div class="user-badge">
                    <div class="avatar">{{ strtoupper(substr(auth()->user()->name, 0, 2)) }}</div>
                    <strong>{{ ucfirst(auth()->user()->name) }}</strong>
                </div>
            </div>
        </header>

        <!-- SIDEBAR -->
        <aside class="sidebar">
            <span class="sidebar-section-label">Content</span>
            <a class="sidebar-item active" onclick="showPanel('social', this)" href="#">
                <span class="dot"></span> Social Media Links
            </a>
            <a class="sidebar-item" onclick="showPanel('summaries', this)" href="#">
                <span class="dot"></span> Page Summaries
            </a>
            <a class="sidebar-item" onclick="showPanel('summary-links', this)" href="#">
                <span class="dot"></span> Summary Links
            </a>

            <span class="sidebar-section-label">About</span>
            <a class="sidebar-item" onclick="showPanel('about-users', this)" href="#">
                <span class="dot"></span> About Users
            </a>
            <a class="sidebar-item" onclick="showPanel('about-links', this)" href="#">
                <span class="dot"></span> About Links
            </a>

            <span class="sidebar-section-label">Work</span>
            <a class="sidebar-item" onclick="showPanel('experiences', this)" href="#">
                <span class="dot"></span> Experiences
            </a>
            <a class="sidebar-item" onclick="showPanel('exp-languages', this)" href="#">
                <span class="dot"></span> Exp. Languages
            </a>
            <a class="sidebar-item" onclick="showPanel('projects', this)" href="#">
                <span class="dot"></span> Projects
            </a>

            <div class="sidebar-logout">
                <form action="/logout" method="POST">
                    @csrf
                    <button class="btn-logout" type="submit">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                            <polyline points="16,17 21,12 16,7"/>
                            <line x1="21" y1="12" x2="9" y2="12"/>
                        </svg>
                        Logout
                    </button>
                </form>
            </div>
        </aside>

        <!-- MAIN CONTENT -->
        <main class="main">

            <!-- ── SOCIAL MEDIA LINKS ── -->
            <div id="panel-social" class="section-panel active">
                <div class="panel-header">
                    <h2 class="panel-title">Social Media <span>Links</span></h2>
                    <span class="record-count">{{ $socialMediaLinks->count() }} records</span>
                </div>

                @if($socialMediaLinks->count() > 0)
                    <div class="table-wrap">
                        <table>
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Link Name</th>
                                <th>URL</th>
                                <th>Updated</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($socialMediaLinks as $link)
                                <tr>
                                    <td class="muted">{{ $link->id }}</td>
                                    <form action="/update-social-media-link/{{ $link->id }}" method="POST" class="td-form">
                                        @csrf @method('PUT')
                                        <td><input type="text" name="link_name" value="{{ $link->link_name }}" required></td>
                                        <td><input type="text" name="link_url" value="{{ $link->link_url }}" required></td>
                                        <td class="muted">{{ \Carbon\Carbon::parse($link->updated_at)->format('d M Y') }}</td>
                                        <td>
                                            <button class="btn btn-update" type="submit">Save</button>
                                    </form>
                                    <form action="/delete-social-media-link/{{ $link->id }}" method="POST" style="display:inline">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-delete" type="submit">Delete</button>
                                    </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="empty-state">No social media links yet.</div>
                @endif

                <div class="add-card">
                    <p class="add-card-title">+ Add New Link</p>
                    <form action="/add-social-media-link" method="POST">
                        @csrf
                        <div class="form-grid">
                            <div class="field">
                                <label>Link Name</label>
                                <input type="text" name="link_name" placeholder="e.g. GitHub" required>
                            </div>
                            <div class="field">
                                <label>URL</label>
                                <input type="text" name="link_url" placeholder="https://..." required>
                            </div>
                            <button class="btn btn-add" type="submit">Add</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- ── PAGE SUMMARIES ── -->
            <div id="panel-summaries" class="section-panel">
                <div class="panel-header">
                    <h2 class="panel-title">Page <span>Summaries</span></h2>
                    <span class="record-count">{{ $pageSummaries->count() }} records</span>
                </div>

                @if($pageSummaries->count() > 0)
                    <div class="table-wrap">
                        <table>
                            <thead>
                            <tr><th>#</th><th>Muted Text</th><th>Title</th><th>Subtitle</th><th>Updated</th><th>Actions</th></tr>
                            </thead>
                            <tbody>
                            @foreach($pageSummaries as $summary)
                                <tr>
                                    <td class="muted">{{ $summary->id }}</td>
                                    <form action="/update-page-summary/{{ $summary->id }}" method="POST" class="td-form">
                                        @csrf @method('PUT')
                                        <td><input type="text" name="muted_text" value="{{ $summary->muted_text }}"></td>
                                        <td><input type="text" name="title" value="{{ $summary->title }}" required></td>
                                        <td><input type="text" name="sub_title" value="{{ $summary->sub_title }}"></td>
                                        <td class="muted">{{ \Carbon\Carbon::parse($summary->updated_at)->format('d M Y') }}</td>
                                        <td>
                                            <button class="btn btn-update" type="submit">Save</button>
                                    </form>
                                    <form action="/delete-page-summary/{{ $summary->id }}" method="POST" style="display:inline">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-delete" type="submit">Delete</button>
                                    </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="empty-state">No page summaries yet.</div>
                @endif

                <div class="add-card">
                    <p class="add-card-title">+ Add New Summary</p>
                    <form action="/add-page-summary" method="POST">
                        @csrf
                        <div class="form-grid">
                            <div class="field">
                                <label>Muted Text</label>
                                <input type="text" name="muted_text" placeholder="e.g. Hello, I'm">
                            </div>
                            <div class="field">
                                <label>Title *</label>
                                <input type="text" name="title" placeholder="Main Title" required>
                            </div>
                            <div class="field">
                                <label>Subtitle</label>
                                <input type="text" name="sub_title" placeholder="Subtitle">
                            </div>
                            <button class="btn btn-add" type="submit">Add</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- ── PAGE SUMMARY LINKS ── -->
            <div id="panel-summary-links" class="section-panel">
                <div class="panel-header">
                    <h2 class="panel-title">Summary <span>Links</span></h2>
                    <span class="record-count">{{ $pageSummaryLinks->count() }} records</span>
                </div>

                @if($pageSummaryLinks->count() > 0)
                    <div class="table-wrap">
                        <table>
                            <thead>
                            <tr><th>#</th><th>Summary</th><th>Name</th><th>Type</th><th>URL</th><th>Actions</th></tr>
                            </thead>
                            <tbody>
                            @foreach($pageSummaryLinks as $link)
                                <tr>
                                    <td class="muted">{{ $link->id }}</td>
                                    <td class="muted">{{ $link->page_summary_id }}</td>
                                    <form action="/update-page-summary-link/{{ $link->id }}" method="POST" class="td-form">
                                        @csrf @method('PUT')
                                        <td><input type="text" name="link_name" value="{{ $link->link_name }}" required></td>
                                        <td><input type="text" name="link_type" value="{{ $link->link_type }}" required></td>
                                        <td><input type="text" name="link_url" value="{{ $link->link_url }}" required></td>
                                        <td>
                                            <button class="btn btn-update" type="submit">Save</button>
                                    </form>
                                    <form action="/delete-page-summary-link/{{ $link->id }}" method="POST" style="display:inline">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-delete" type="submit">Delete</button>
                                    </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="empty-state">No summary links yet.</div>
                @endif

                <div class="add-card">
                    <p class="add-card-title">+ Add Summary Link</p>
                    <form action="/add-page-summary-link" method="POST">
                        @csrf
                        <div class="form-grid">
                            <div class="field">
                                <label>Page Summary</label>
                                <select name="page_summary_id" required>
                                    <option value="">Select Summary</option>
                                    @foreach($pageSummaries as $summary)
                                        <option value="{{ $summary->id }}">{{ $summary->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="field">
                                <label>Name</label>
                                <input type="text" name="link_name" placeholder="Link Name" required>
                            </div>
                            <div class="field">
                                <label>Type</label>
                                <input type="text" name="link_type" placeholder="e.g. button" required>
                            </div>
                            <div class="field">
                                <label>URL</label>
                                <input type="text" name="link_url" placeholder="https://..." required>
                            </div>
                            <button class="btn btn-add" type="submit">Add</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- ── ABOUT USERS ── -->
            <div id="panel-about-users" class="section-panel">
                <div class="panel-header">
                    <h2 class="panel-title">About <span>Users</span></h2>
                    <span class="record-count">{{ $aboutUsers->count() }} records</span>
                </div>

                @if($aboutUsers->count() > 0)
                    <div class="table-wrap">
                        <table>
                            <thead>
                            <tr><th>#</th><th>Summary</th><th>Updated</th><th>Actions</th></tr>
                            </thead>
                            <tbody>
                            @foreach($aboutUsers as $aboutUser)
                                <tr>
                                    <td class="muted">{{ $aboutUser->id }}</td>
                                    <form action="/update-about-user/{{ $aboutUser->id }}" method="POST" class="td-form">
                                        @csrf @method('PUT')
                                        <td><input type="text" name="summary" value="{{ $aboutUser->summary }}" required></td>
                                        <td class="muted">{{ \Carbon\Carbon::parse($aboutUser->updated_at)->format('d M Y') }}</td>
                                        <td>
                                            <button class="btn btn-update" type="submit">Save</button>
                                    </form>
                                    <form action="/delete-about-user/{{ $aboutUser->id }}" method="POST" style="display:inline">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-delete" type="submit">Delete</button>
                                    </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="empty-state">No about user records yet.</div>
                @endif

                <div class="add-card">
                    <p class="add-card-title">+ Add About User</p>
                    <form action="/add-about-user" method="POST">
                        @csrf
                        <div class="form-grid">
                            <div class="field">
                                <label>Summary</label>
                                <input type="text" name="summary" placeholder="A short bio..." required>
                            </div>
                            <button class="btn btn-add" type="submit">Add</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- ── ABOUT LINKS ── -->
            <div id="panel-about-links" class="section-panel">
                <div class="panel-header">
                    <h2 class="panel-title">About <span>Links</span></h2>
                    <span class="record-count">{{ $aboutLinks->count() }} records</span>
                </div>

                @if($aboutLinks->count() > 0)
                    <div class="table-wrap">
                        <table>
                            <thead>
                            <tr><th>#</th><th>User</th><th>Name</th><th>Icon</th><th>Type</th><th>URL</th><th>Actions</th></tr>
                            </thead>
                            <tbody>
                            @foreach($aboutLinks as $link)
                                <tr>
                                    <td class="muted">{{ $link->id }}</td>
                                    <td class="muted">{{ $link->about_user_id }}</td>
                                    <form action="/update-about-link/{{ $link->id }}" method="POST" class="td-form">
                                        @csrf @method('PUT')
                                        <td><input type="text" name="link_name" value="{{ $link->link_name }}" required></td>
                                        <td><input type="text" name="link_icon" value="{{ $link->link_icon }}"></td>
                                        <td><input type="text" name="link_type" value="{{ $link->link_type }}" required></td>
                                        <td><input type="text" name="link_url" value="{{ $link->link_url }}" required></td>
                                        <td>
                                            <button class="btn btn-update" type="submit">Save</button>
                                    </form>
                                    <form action="/delete-about-link/{{ $link->id }}" method="POST" style="display:inline">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-delete" type="submit">Delete</button>
                                    </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="empty-state">No about links yet.</div>
                @endif

                <div class="add-card">
                    <p class="add-card-title">+ Add About Link</p>
                    <form action="/add-about-link" method="POST">
                        @csrf
                        <div class="form-grid">
                            <div class="field">
                                <label>About User</label>
                                <select name="about_user_id" required>
                                    <option value="">Select User</option>
                                    @foreach($aboutUsers as $au)
                                        <option value="{{ $au->id }}">User #{{ $au->id }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="field">
                                <label>Name</label>
                                <input type="text" name="link_name" placeholder="Link Name" required>
                            </div>
                            <div class="field">
                                <label>Icon</label>
                                <input type="text" name="link_icon" placeholder="fa-github">
                            </div>
                            <div class="field">
                                <label>Type</label>
                                <input type="text" name="link_type" placeholder="e.g. social" required>
                            </div>
                            <div class="field">
                                <label>URL</label>
                                <input type="text" name="link_url" placeholder="https://..." required>
                            </div>
                            <button class="btn btn-add" type="submit">Add</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- ── EXPERIENCES ── -->
            <div id="panel-experiences" class="section-panel">
                <div class="panel-header">
                    <h2 class="panel-title"><span>Experiences</span></h2>
                    <span class="record-count">{{ $experiences->count() }} records</span>
                </div>

                @if($experiences->count() > 0)
                    <div class="table-wrap">
                        <table>
                            <thead>
                            <tr><th>#</th><th>Title</th><th>Start</th><th>End</th><th>Summary</th><th>Actions</th></tr>
                            </thead>
                            <tbody>
                            @foreach($experiences as $exp)
                                <tr>
                                    <td class="muted">{{ $exp->id }}</td>
                                    <form action="/update-experience/{{ $exp->id }}" method="POST" class="td-form">
                                        @csrf @method('PUT')
                                        <td><input type="text" name="title" value="{{ $exp->title }}" required></td>
                                        <td><input type="date" name="start_date" value="{{ $exp->start_date }}" required></td>
                                        <td><input type="date" name="end_date" value="{{ $exp->end_date }}"></td>
                                        <td><input type="text" name="summary" value="{{ $exp->summary }}" required></td>
                                        <td>
                                            <button class="btn btn-update" type="submit">Save</button>
                                    </form>
                                    <form action="/delete-experience/{{ $exp->id }}" method="POST" style="display:inline">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-delete" type="submit">Delete</button>
                                    </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="empty-state">No experiences yet.</div>
                @endif

                <div class="add-card">
                    <p class="add-card-title">+ Add Experience</p>
                    <form action="/add-experience" method="POST">
                        @csrf
                        <div class="form-grid">
                            <div class="field">
                                <label>Title *</label>
                                <input type="text" name="title" placeholder="Job / Role Title" required>
                            </div>
                            <div class="field">
                                <label>Start Date *</label>
                                <input type="date" name="start_date" required>
                            </div>
                            <div class="field">
                                <label>End Date</label>
                                <input type="date" name="end_date">
                            </div>
                            <div class="field">
                                <label>Summary *</label>
                                <input type="text" name="summary" placeholder="Brief description..." required>
                            </div>
                            <button class="btn btn-add" type="submit">Add</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- ── EXPERIENCE LANGUAGES ── -->
            <div id="panel-exp-languages" class="section-panel">
                <div class="panel-header">
                    <h2 class="panel-title">Experience <span>Languages</span></h2>
                    <span class="record-count">{{ $experienceLanguages->count() }} records</span>
                </div>

                @if($experienceLanguages->count() > 0)
                    <div class="table-wrap">
                        <table>
                            <thead>
                            <tr><th>#</th><th>Experience</th><th>Language</th><th>Actions</th></tr>
                            </thead>
                            <tbody>
                            @foreach($experienceLanguages as $lang)
                                <tr>
                                    <td class="muted">{{ $lang->id }}</td>
                                    <td class="muted">{{ $lang->experience_id }}</td>
                                    <form action="/update-experience-language/{{ $lang->id }}" method="POST" class="td-form">
                                        @csrf @method('PUT')
                                        <td><input type="text" name="language_name" value="{{ $lang->language_name }}" required></td>
                                        <td>
                                            <button class="btn btn-update" type="submit">Save</button>
                                    </form>
                                    <form action="/delete-experience-language/{{ $lang->id }}" method="POST" style="display:inline">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-delete" type="submit">Delete</button>
                                    </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="empty-state">No experience languages yet.</div>
                @endif

                <div class="add-card">
                    <p class="add-card-title">+ Add Language</p>
                    <form action="/add-experience-language" method="POST">
                        @csrf
                        <div class="form-grid">
                            <div class="field">
                                <label>Experience</label>
                                <select name="experience_id" required>
                                    <option value="">Select Experience</option>
                                    @foreach($experiences as $exp)
                                        <option value="{{ $exp->id }}">{{ $exp->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="field">
                                <label>Language Name *</label>
                                <input type="text" name="language_name" placeholder="e.g. PHP, JavaScript" required>
                            </div>
                            <button class="btn btn-add" type="submit">Add</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- ── PROJECTS ── -->
            <div id="panel-projects" class="section-panel">
                <div class="panel-header">
                    <h2 class="panel-title"><span>Projects</span></h2>
                    <span class="record-count">{{ $projects->count() }} records</span>
                </div>

                @if($projects->count() > 0)
                    <div class="table-wrap">
                        <table>
                            <thead>
                            <tr><th>#</th><th>Name</th><th>Cover Img</th><th>Summary</th><th>URL</th><th>Actions</th></tr>
                            </thead>
                            <tbody>
                            @foreach($projects as $project)
                                <tr>
                                    <td class="muted">{{ $project->id }}</td>
                                    <form action="/update-project/{{ $project->id }}" method="POST" class="td-form">
                                        @csrf @method('PUT')
                                        <td><input type="text" name="name" value="{{ $project->name }}" required></td>
                                        <td><input type="text" name="cover_img" value="{{ $project->cover_img }}"></td>
                                        <td><input type="text" name="summary" value="{{ $project->summary }}" required></td>
                                        <td><input type="text" name="project_url" value="{{ $project->project_url }}"></td>
                                        <td>
                                            <button class="btn btn-update" type="submit">Save</button>
                                    </form>
                                    <form action="/delete-project/{{ $project->id }}" method="POST" style="display:inline">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-delete" type="submit">Delete</button>
                                    </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="empty-state">No projects yet.</div>
                @endif

                <div class="add-card">
                    <p class="add-card-title">+ Add Project</p>
                    <form action="/add-project" method="POST">
                        @csrf
                        <div class="form-grid">
                            <div class="field">
                                <label>Name *</label>
                                <input type="text" name="name" placeholder="Project Name" required>
                            </div>
                            <div class="field">
                                <label>Cover Image URL</label>
                                <input type="text" name="cover_img" placeholder="https://...">
                            </div>
                            <div class="field">
                                <label>Summary *</label>
                                <input type="text" name="summary" placeholder="Brief description..." required>
                            </div>
                            <div class="field">
                                <label>Project URL</label>
                                <input type="text" name="project_url" placeholder="https://...">
                            </div>
                            <button class="btn btn-add" type="submit">Add</button>
                        </div>
                    </form>
                </div>
            </div>

        </main>
    </div>

@else

    <!-- GUEST VIEW -->
    <div class="guest-screen">
        @if(session('message'))
            <div class="flash-msg">{{ session('message') }}</div>
        @endif
        <div class="mark"></div>
        <h1 class="guest-title">Tebogo <span>Malebana</span></h1>
        <p>Sign in to manage your portfolio content — links, summaries, experience, and projects.</p>
        <div class="guest-links">
            <a href="/login" class="a-primary">Login</a>
            <a href="/register" class="a-secondary">Register</a>
        </div>
    </div>

@endauth

<script src="{{ asset('js/dashboard.js') }}"></script>
</body>
</html>
