
<html>
	<head>
	</head>
	<body>
		
	</body>
</html>
<html>
	<head>
        <title>{{ config('app.name', 'Laravel') }}</title>
        
        <link rel="stylesheet" type="text/css" href="{{ asset('css/index_style.css') }}" />
        
        <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,700">

		<link rel="stylesheet" type="text/css" href="{{ asset('css/header_style.css') }}" />
	</head>
	<body>
        <header>
			<a href="./">
				<div id="cd-logo">
					<img src="{{ asset('img/ic_logo2.svg') }}" alt="Logo" width="45" height="45" />
					<p>{{ config('app.name', 'Laravel') }}</p>
				</div>
			</a>
		</header>
		<div id="allTheThings">
			<div id="member">
				<a href="{{ route('login.student') }}">
					<img src="{{ asset('img/ic_membership.svg') }}" width="250px" height="auto"/><br />
					&nbsp;Student Login
				</a>
			</div>
			<div id="verticalLine">
				<div id="librarian">
					<a id="librarian-link" href="{{ route('login.teacher') }}">
						<img src="{{ asset('img/ic_librarian2.svg') }}" width="250px" height="220" /><br />
						&nbsp;&nbsp;&nbsp;Teacher Login
					</a>
				</div>
			</div>
		</div>
	</body>
</html>