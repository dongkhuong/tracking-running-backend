@extends('layout.blank')

@section('content')
<div class="login-box-body">
    <h2 class="text-header">Đặt Mật Khẩu mới</h2>
    @if(isset($signature))
    <form action="{{ route('reset-password.update') }}" method="post">
        @csrf
        <input type="hidden" value="{{ $signature }}" name="signature">
        @include('inc.input', ['attr' => 'password', 'label' => 'Mật khẩu', 'type' => 'password', 'placeHolder' => 'Nhập mật khẩu'])
        @include('inc.input', ['attr' => 'password_confirm','label' => 'Nhập lại mật khẩu', 'type' => 'password', 'placeHolder' => 'Nhập lại mật khẩu'])
        <div class="row">
            <!-- /.col -->
            <div class="col-lg-8 offset-md-2">
                <button type="submit" class="btn btn-primary btn-block btn-sign-in">Reset Password</button> </div>
            <!-- /.col -->
        </div>
        </div>
    </form>
    @endif
</div>
@endsection
