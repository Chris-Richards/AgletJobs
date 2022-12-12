<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/x-icon" href="/Logo.png">

    <title>{{ $title }}</title>


    @section('head_content')
    <meta name="title" content="Aglet Jobs - Find Jobs Online">
    <meta name="description" content="Aglet Jobs helps people find jobs online in the easiest way possible">
    @show



    <meta property="og:image" content="/Logo.png" />

    <meta name="keywords" content="Jobs, Online jobs, job search, mining jobs">
    <meta name="robots" content="index, follow">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="language" content="English">

    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="{{ asset('js/minely.js?v=1.2') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
    <link href="{{ asset('css/style.css?v=1.2') }}" rel="stylesheet">
    <!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-QZD4XTJ4QS"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-QZD4XTJ4QS');
</script>

<!-- Google tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-250062195-1">
</script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-250062195-1');
</script>
</head>
<body class="d-flex flex-column h-100">
    <div id="app">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container">
    <a class="navbar-brand" href="/">
        <img src="/Navlogo.png">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="/">Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/about">Resources</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/job/create">Create Job Ad</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/resume">Resume Builder</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/contact-us">Contact Us</a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                        <li class="nav-item dropdown">
                          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->name }}
                          </a>
                          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            @if(Auth::user()->account_type == 1)
                                <li><a class="dropdown-item" href="/profile">My Profile</a></li>
                                <li><hr class="dropdown-divider"></li>
                            @endif
                            @if(Auth::user()->account_type == 2)
                                <li><a class="dropdown-item" href="/my-jobs">My Job Ads</a></li>
                                <li><a class="dropdown-item" href="/candidates">Find Candidates</a></li>
                                <li><hr class="dropdown-divider"></li>
                            @endif
                            @if(Auth::user()->account_type == 3)
                                <li><a class="dropdown-item" href="/my-jobs">My Job Ads</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="/candidates">Find Candidates</a></li>
                                <li>
                                    <a class="dropdown-item" href="/admin">Admin Dashboard</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="/admin/blogs">Blog Dashboard</a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                            @endif
                            <li><a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form></li>
                          </ul>
                        </li>
                        @endguest
                    </ul>
    </div>
  </div>
</nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>

<footer class="py-5" style="padding-bottom: 0 !important;">
    <div class="container">
        <div class="row">
          <div class="col-md-3">
            <h5>Links</h5>
            <hr>
            <ul class="nav flex-column">
              <li class="nav-item mb-2"><a href="/" class="nav-link p-0 text-muted">Home</a></li>
              <li class="nav-item mb-2"><a href="/about" class="nav-link p-0 text-muted">Resources</a></li>
              <li class="nav-item mb-2"><a href="/job/create" class="nav-link p-0 text-muted">Create Job Ad</a></li>
              <li class="nav-item mb-2"><a href="/resume" class="nav-link p-0 text-muted">Resume Builder</a></li>
              <li class="nav-item mb-2"><a href="/contact-us" class="nav-link p-0 text-muted">Contact Us</a></li>
            </ul>
          </div>

          <div class="col-md-3">
            <h5>About Aglet</h5>
            <hr>
            <ul class="nav flex-column">
              <li class="nav-item mb-2"><a href="/privacy" class="nav-link p-0 text-muted">Privacy Statement</a></li>
              <li class="nav-item mb-2"><a href="/tos" class="nav-link p-0 text-muted">Terms & Conditions</a></li>
            </ul>
          </div>

          <div class="col-md-3">
            <h5>Social</h5>
            <hr>
            <ul class="nav flex-column">
              <li class="nav-item mb-2"><a href="https://www.facebook.com/agletjobs" class="nav-link p-0 text-muted">Facebook</a></li>
              <li class="nav-item mb-2"><a href="mailto:agletjobs@gmail.com" class="nav-link p-0 text-muted">Email</a></li>
            </ul>
          </div>

          <div class="col-md-3">
            <h5>AgletJobs</h5>
            <hr>
            <p>Find your dream job, faster and easier than ever before on AgletJobs</p>
          </div>
        </div>


        <div class="d-flex justify-content-between py-4 my-4 border-top" style="padding-bottom: 0 !important;">
          {{-- <p>© 2021 Company, Inc. All rights reserved.</p> --}}
           <p>&#169; {{ date("Y") }} AgletJobs. All rights reserved</p>
          <ul class="list-unstyled d-flex">
            <li class="ms-3"><a class="link-dark" href="#"><svg class="bi" width="24" height="24"><use xlink:href="#twitter"></use></svg></a></li>
            <li class="ms-3"><a class="link-dark" href="#"><svg class="bi" width="24" height="24"><use xlink:href="#instagram"></use></svg></a></li>
            <li class="ms-3"><a class="link-dark" href="#"><svg class="bi" width="24" height="24"><use xlink:href="#facebook"></use></svg></a></li>
          </ul>
        </div>
    </div>
  </footer>

{{-- <footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="footer-list">
                    <h4>AgletJobs</h4>
                    <span>Find your dream job, faster and easier than ever before on AgletJobs</span>
                </div>
            </div>
            <div class="col-md-3">
                <div class="footer-list">
                    <h4>Links</h4>
                    <a href="/">Home</a>
                    <a href="/about">Resources</a>
                    <a href="/job/create">Create Job Ad</a>
                    <a href="/resume">Resume</a>
                    <a href="/contact-us">Contact Us</a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="footer-list">
                    <h4>About Aglet</h4>
                    <a href="/">Privacy Statement</a>
                    <a href="/about">Terms & Conditions</a>
                    <a href="/job/create">Protect yourself online</a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="footer-list">
                    <h4>Social</h4>
                    <a href="/">Facebook</a>
                    <a href="/about">Instagram</a>
                    <a href="/job/create">Email</a>
                </div>
            </div>
        </div>
    </div>
    <div style="text-align: center; border-top: 2px solid #6246EA; position: absolute; bottom: 0; width: 100%; padding:4px">
        <span>&#169; AgletJobs {{ date("Y") }}. All rights reserved</span>
    </div>
</footer> --}}
</body>
</html>
