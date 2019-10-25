@extends('layout.blank')

@section('content')
<link href="{{ asset('assets/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/css/signup.css') }}" rel="stylesheet" type="text/css" />
<script src="{{ asset('assets/js/moment.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap-datetimepicker.min.js') }}"></script>
<div class="login-box-body">
	<h2 class="text-header">Đăng ký</h2>

	<form action="{{ route('register.store') }}" method="post">
		@csrf
		@include('inc.input', ['attr' => 'lastname', 'label' => 'Tên', 'placeHolder' => 'Nhập họ', 'class' => 'left-group'])
		@include('inc.input', ['attr' => 'firstname', 'label' => 'Tên', 'placeHolder' => 'Nhập tên', 'class' => 'right-group'])
		<div class="clear"></div>
		@include('inc.input', ['attr' => 'phone', 'label' => 'Phone', 'type' => 'number', 'placeHolder' => 'Nhập số điện thoại'])
		@include('inc.input', ['attr' => 'email', 'label' => 'Email', 'type' => 'email', 'placeHolder' => 'Nhập Email'])
		@include('inc.input', ['attr' => 'birthday', 'label' => 'Ngày sinh', 'placeHolder' => 'Nhập ngày sinh', 'inputClass' => 'datetime'])
		@include('inc.input', ['attr' => 'password', 'label' => 'Mật khẩu', 'type' => 'password', 'placeHolder' => 'Nhập mật khẩu'])
		@include('inc.input', ['attr' => 'password_confirm','label' => 'Nhập lại mật khẩu', 'type' => 'password', 'placeHolder' => 'Nhập lại mật khẩu'])
		<div class="row">
			<div class="col-lg-8">
			</div>
			<!-- /.col -->
			<div class="col-lg-4">
				<button type="submit" class="btn btn-primary btn-block">Đăng ký</button> </div>
			<!-- /.col -->
		</div>
	</form>
	<div class="sign-up">Bạn đã có tài khoản? <a href="/login" class="text-center">Đăng nhập</a></div>
	<a href="/reset-passwords" class="text-center">Quên mật khẩu</a>
</div>

<script type="text/javascript">
	$(function () {
		$('.datetime').datetimepicker({
			format: 'DD-MM-YYYY',
			showClose: true,
			// defaultDate: 'now',
			maxDate: 'now'
		});
	});
</script>
@endsection
