@extends('layout.main')

@section('content')
<div class="box box-danger">
    <div class="box-header with-border">
        <h3 class="box-title">Change password</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <div class="tab-pane" id="settings">
            <form id="update-user-form" class="form-horizontal" action="{{ route('change-password.update') }}" method="post">
                @csrf
                @include('inc.input-row', [
                    'attr' => 'old_password',
                    'label' => 'Old password',
                    'type' => 'password',
                    'placeHolder' => 'Old password',
                    'labelCol' => 2,
                    'inputCol' => 10
                ])
                @include('inc.input-row', [
                    'attr' => 'new_password',
                    'label' => 'New password',
                    'type' => 'password',
                    'placeHolder' => 'New password',
                    'labelCol' => 2,
                    'inputCol' => 10
                ])
                @include('inc.input-row', [
                    'attr' => 'new_password_confirm',
                    'label' => 'New password confirm',
                    'type' => 'password',
                    'placeHolder' => 'New password confirm',
                    'labelCol' => 2,
                    'inputCol' => 10
                ])
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-2">
                        <button type="submit" class="btn btn-danger btn-block btn-flat" name="profile-button">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- /.box-body -->
</div>
<!-- /.row -->
@endsection
