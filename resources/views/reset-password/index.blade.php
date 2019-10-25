@extends('layout.blank')

@section('content')
<div class="login-box-body">
    <h2 class="text-header">Khôi Phục Mật Khẩu</h2>
    @include('inc.flash-message')

    <form action="{{ route('reset-password.send') }}" method="post">
        @csrf
        <!-- /.login-logo -->
        <div class="form-group {{ $errors->has('email') ? 'has-error' : null }}">
            <label class="control-label">Email</label>
            <input type="email" id="email" class="form-control" required="true" name="email" placeholder="Enter Your Email" aria-required="true">
            <p class="help-block help-block-error">{{ $errors->any() ? 'Incorrect email or Email is not exist' : null }}</p>
        </div>
        <div class="row">
            <!-- /.col -->
            <div class="col-lg-8 offset-md-2">
                <button type="submit" class="btn btn-primary btn-block btn-sign-in">Reset Password</button> </div>
            <!-- /.col -->
        </div>
        <div class="sign-up">Bạn đã có tài khoản? <a href="{{ route('login.index') }}" class="text-center">Đăng nhập</a></div>
        <div class="sign-up">Don’t have an account yet? <a href="{{ route('register.index') }}" class="text-center">Sign Up</a>
        </div>
    </form>
</div>
@endsection
