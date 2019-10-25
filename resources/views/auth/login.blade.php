@extends('layout.blank')

@section('content')
<div class="login-box-body">
	<h2 class="text-header">Đăng nhập</h2>
	<form action="{{ route('login.store') }}" method="post">
		@csrf
		<!-- /.login-logo -->
		<div class="form-group">
			<label class="control-label">Email</label>
			<input type="email" id="email" class="form-control" name="email" placeholder="Enter Your Email" aria-required="true" value="{{ old('email') }}">
		</div>
		<div class="form-group {{ $errors->has('email') ? 'has-error' : null }}">
			<label class="control-label">Password</label>
			<input type="password" id="password" class="form-control" name="password" placeholder="Enter Your Password" aria-required="true" value="{{ old('password') }}">

			<p class="help-block help-block-error">{{ $errors->any() ? 'Incorrect email address or password.' : null }}</p>
        </div>
        <div class="form-group">
            <input type="checkbox" name="remember"><span>Remember Me</span>
        </div>
		<a href="/reset-passwords" class="text-center">Forgot password</a><br>
		<div class="row">
			<div class="col-lg-8">
			</div>
			<!-- /.col -->
			<div class="col-lg-4">
				<button type="submit" class="btn btn-primary btn-block btn-sign-in">Sign In</button> </div>
			<!-- /.col -->
		</div>
		<div class="sign-up">Don’t have an account yet? <a href="{{ route('register.index') }}" class="text-center">Sign Up</a>
		</div>
	</form>
</div>
@endsection
