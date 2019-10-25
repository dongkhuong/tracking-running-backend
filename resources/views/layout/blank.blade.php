<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

	<title>{{ config('app.name') }}</title>
	<link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ asset('assets/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ asset('assets/css/AdminLTE.min.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ asset('assets/css/blank-form.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ asset('assets/css/main.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ asset('assets/css/blank.css') }}" rel="stylesheet" type="text/css" />

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

	<!-- Google Font -->
	<!-- Custom fonts for this template -->
	<link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

	<link href='https://fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900italic,900' rel='stylesheet' type='text/css'>
	<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
</head>
<body class="hold-transition login-page">
	<div class="login-box">
		<div class="login-logo">
			<a href="/" title="Home">
				<!-- <img class="logo" alt="Vu Gia Bus Logo" src="/public/assets/img/logo.png"> -->
				<span class="header snp-name">{{ config('app.name') }}</span>
			</a>
		</div>
		@yield('content')
	</div>
</body>
<script src="{{ asset('assets/js/jquery-ui.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.slimscroll.min.js') }}"></script>
<script src="{{ asset('assets/js/adminlte.min.js') }}"></script>
</html>
