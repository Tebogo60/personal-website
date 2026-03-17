<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tebogo Malebana</title>

    <link rel="shortcut icon" href="img/favicon.png" type="image/x-icon" />

    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}" />

    <!-- Styling -->
    <link rel="stylesheet" href="{{ asset('css/root_colors.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}" />

    <!-- Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet"
    />
</head>
<body>
<a href="#" class="return opacity-0">
    <i class="fas fa-arrow-down" style="rotate: 180deg"></i>
    <span>back <b>Top</b></span>
</a>

<div class="bg_box">
    <div class="boxes"></div>
</div>

<div class="indicator_track">
    <div class="indicator"></div>
</div>

<nav class="navbar navbar-expand-sm fixed-top blur">
    <div class="container">
        <div class="navbar-brand text-blue-100">
            <span class="brand_logo"></span>
            <a href="#"> <b>Tebogo</b> Malebana </a>
        </div>
    </div>
</nav>

<main>

    <!-- ── JUMBOTRON ── -->
    <section id="jumbotron">
        <div class="container">
            <div class="row">
                <div class="jumbo-grid">

                    @foreach($pageSummaries as $summary)
                        @if($summary->muted_text)
                            <div class="small text-blue-100">
                                <span></span>
                                {{ $summary->muted_text }}
                            </div>
                        @endif

                        <h1 class="heading">
                            @php $words = explode(' ', strtoupper($summary->title)); @endphp
                            @foreach($words as $word)
                                <span>{{ $word }}</span>
                            @endforeach
                        </h1>

                        @if($summary->sub_title)
                            <h3 class="sub-heading">
                                {{ $summary->sub_title }}
                            </h3>
                        @endif
                    @endforeach

                    <div class="jumbo_btns">
                        @foreach($pageSummaryLinks as $link)
                            <a href="{{ $link->link_url }}" class="button text-blue-100">
                                <span>{{ $link->link_name }}</span>
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    </section>

    <!-- ── ABOUT ── -->
    <section id="about">
        <div class="container">
            <div class="row justify-content-end">
                <h1 class="heading left-heading">
                    <span>ABOUT</span>
                    <span>ME</span>
                </h1>

                <div class="col-md-6 about-text text-blue-100">

                    <!-- Social Media Links -->
                    <div class="social_media">
                        @foreach($socialMediaLinks as $link)
                            <a target="_blank" href="{{ $link->link_url }}">
                                <i class="{{ $link->link_name }}"></i>
                            </a>
                        @endforeach
                    </div>
                    <br />

                    <!-- About Paragraphs -->
                    @foreach($aboutUsers as $aboutUser)
                        <p>{{ $aboutUser->summary }}</p>
                    @endforeach

                    <!-- About Links (Experience / Projects buttons) -->
                    @foreach($aboutLinks as $link)
                        <a href="{{ $link->link_url }}" class="button text-blue-100">
                            <span>{{ $link->link_name }}</span>
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    @endforeach

                </div>
            </div>
        </div>
    </section>

    <!-- ── EXPERIENCE ── -->
    <section id="experience">
        <div class="container">
            <div class="row">
                <h1 class="heading">
                    <span>EXPE-</span>
                    <span>RIENCE</span>
                </h1>
                <h3 class="sub-heading">
                    Unlocking Digital Potential: Explore My Proficiencies Below.
                </h3>

                @foreach($experiences as $experience)
                    <div class="col-md-4 text-blue-100">
                        <div class="s_card">
                            <p>
                                <i class="text-blue-500">
                                    {{ \Carbon\Carbon::parse($experience->start_date)->format('Y') }}
                                    -
                                    {{ $experience->end_date ? \Carbon\Carbon::parse($experience->end_date)->format('Y') : 'Present' }}
                                </i>
                                <br />
                                <b>{{ $experience->title }}</b>
                                <br /><br />
                                {{ $experience->summary }}
                            </p>
                            <span class="tag">
                                        @foreach($experienceLanguages->where('experience_id', $experience->id) as $lang)
                                    {{ $lang->language_name }}{{ !$loop->last ? ',' : '' }}
                                @endforeach
                                    </span>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>

    <!-- ── PROJECTS ── -->
    <section id="projects">
        <div class="container">
            <div class="row">
                <h1 class="heading">
                    <span>PRO-</span>
                    <span>JECTS</span>
                </h1>
                <h3 class="sub-heading">
                    My Digital Footprint: Explore My Captivating Projects Below.
                </h3>

                @foreach($projects as $project)
                    <div class="col-md-4">
                        <div class="p_card">
                            @if($project->cover_img)
                                <div class="p_card_img">
                                    <img src="{{ $project->cover_img }}" alt="{{ $project->name }}" />
                                </div>
                            @endif
                            <div class="s_card">
                                <p>
                                    <b>{{ $project->name }}</b><br /><br />
                                    {{ $project->summary }}
                                </p>
                                @if($project->project_url)
                                    <a href="{{ $project->project_url }}" class="button" target="_blank">
                                        <span>visit <b>Site</b></span>
                                        <i class="fas fa-arrow-right"></i>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>

    <!-- ── GET IN TOUCH ── -->
    <section id="getintouch">
        <div class="container">
            <div class="row justify-content-end">
                <h1 class="heading left-heading">
                    <span>GET IN</span>
                    <span>TOUCH</span>
                </h1>

                <div class="col-md-6 text-blue-100 text-end">
                    <p class="sub-heading">
                        Thank you for visiting my portfolio! If you'd
                        like to connect or discuss opportunities, feel
                        free to reach out via email—it's my preferred
                        method of communication.
                    </p>

                    <b>Email Address:</b><br />
                    <small>tjjmalebana@gmail.com</small>
                    <br /><br />
                    <b>WhatsApp:</b><br />
                    <small>+27 67 057 2758</small>
                    <br /><br />
                    <b>LinkedIn:</b><br />
                    <small class="text-blue-100">
                        <a
                            href="https://www.linkedin.com/in/tebogo-malebana-47b640249/"
                            class="link"
                            target="_blank"
                        >
                            https://www.linkedin.com/in/tebogo-malebana-47b640249/
                        </a>
                    </small>
                </div>
            </div>
        </div>
    </section>

</main>

<footer class="p-5 text-blue-500 blur">
    <small>
        Designed in <b>Figma</b>, coded in <b>Visual Studio Code</b>,
        and built with <b>Bootstrap</b>. Deployed with <b>GitHub</b> and
        set in <b>Montserrat</b> font.
    </small>
</footer>

<script src="{{ asset('js/all.js') }}"></script>
<script src="{{ asset('js/static.js') }}"></script>
<script src="{{ asset('js/main.js') }}"></script>
</body>
</html>
