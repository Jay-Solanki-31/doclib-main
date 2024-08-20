<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/jquery.min.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,700">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/header_style.css') }}" />
    <title>LMS</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/global_styles.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/custom_radio_button_style.css')}} ">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/form_styles.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/index_style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/custom_checkbox_style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/header_librarian_style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/header_member_style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/insert_book_style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/my_books_style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/pending_book_requests_style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/pending_registrations_style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/register_style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/update_balance_style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/update_copies_style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/home_style.css')}} ">
    <link rel="stylesheet" type="text/css" href="{{ asset('icon/material-design-iconic-font/css/materialdesignicons.min.css')}} ">




    {{-- FontAwesome CDN --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />

	</head>
	<body>
        <header>
            <div id="cd-logo">
			    <a href="./">
					<img src="{{ asset('img/ic_logo2.svg') }}" alt="Logo" width="45" height="45" />
					<p>Library Management System</p>
                </a>
            </div>
            @if (Auth::guard('other_user')->user())
            <div class="dropdown">
				<button class="dropbtn">
					<p id="librarian-name">{{ Auth::guard('other_user')->user()->name }}</p>
				</button>
				<div class="dropdown-content">
					<a class="" href="{{ route('user.changePassword') }}">{{ __('Change Password') }}</a>
                    <a class="" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
				</div>
            </div>
            @endif
        </header>
        <div class="col-10 col-md-6 mt-5 offset-md-3 offset-1">
            @include('inc.messages')
        </div>

        <main class="py-4">
            {{-- <div class="container"> --}}
                @yield('content')
            {{-- </div> --}}
        </main>
	</body>
	
		
</html>