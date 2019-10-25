@extends('layout.main')

@section('content')
<?php
    use App\Http\Models\User;
    use App\Http\Models\Image;
?>
<link href="{{ asset('assets/css/profile.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/css/left-profile.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/css/croppie.css') }}" rel="stylesheet" type="text/css" />
<script src="{{ asset('assets/js/croppie.js') }}"></script>
<div class="row">
    <div class="col-md-4 snp-profile">
        <!-- Profile Image -->
        <div class="box box-primary">
            <div class="box-body box-profile snp-box-profile">
                @php 
                    dd($model->image->upload_path)
                @endphp

                <div class="row snp-profile-top">
                    <div class="col-lg-5 change-picture">
                    {{--  @if (isset($model) && $model->image)  --}}
                    <img class="profile-user-img img-responsive img-circle js-avatar"
                        src="{{'/assets/images/avatar-default.png' }}" alt="User profile picture">
                        {{--  $model->image->upload_path ? asset($model->image->upload_path) :   --}}
                    {{--  @endif  --}}
                        <a class="btn-change-picture" data-toggle="modal" data-target="#change-picture">
                            <i class="fa fa-camera"></i>
                        </a>
                    </div>
                    <div class="col-lg-7 snp-user-top-right">
                        <h3 class="profile-username snp-profile-username text-left">{{ $model->fullname() }}</h3>
                        <p class="text-muted">Member since: <span class="snp-created-at">{{ viewFormatDate($model->created_at) }}</span></p>
                    </div>
                </div>

                <div class="snp-profile-header">
                    <span>General</span>
                </div>
                <table class="snp-profile-content">
                    <tbody>
                        <tr>
                            <td class="text-muted snp-profile-model">Gender</td>
                            <td class="text-muted">{{ $model->genderLabel() }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted snp-profile-model">Date of birth</td>
                            <td class="text-muted">{{ viewFormatDate($model->birthday) }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted snp-profile-model" valign="top">Location</td>
                            <td class="text-muted">Viet Nam Da Nang Lien Chieu Hoa Khanh Nam K55/H1/35 Nam Cao</td>
                        </tr>
                    </tbody>
                </table>
                <div class="snp-profile-header">
                    <span>Contact Infomation</span>
                </div>
                <table class="snp-profile-content">
                    <tbody>
                        <tr>
                            <td class="text-muted snp-profile-model">Email</td>
                            <td class="text-muted">{{ $model->email }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted snp-profile-model">Phone</td>
                            <td class="text-muted">{{ $model->phone }}</td>
                        </tr>
                    </tbody>
                </table>
                <a href="{{ route('change-password.index') }}">Change password</a>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>

    <!-- Modal -->
    <div id="change-picture" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h4 class="modal-title">Update Profile Picture</h4>
                </div>
                <div class="modal-body upload-form">
                    <div class="btn-upload">
                        <span><i class="fa fa-plus"></i> Upload Photo</span>
                        <input type="file" id="upload" title="Choose a file to upload" accept="image/*">
                    </div>
                    <div id="preview-upload" class="hide"></div>
                </div>
                <div class="modal-footer hide">
                    <button type="button" class="btn btn-default btn-cancal">Cancel</button>
                    <button type="button" class="btn btn-primary btn-save" data-dismiss="modal">Save</button>
                </div>
            </div>
        </div>
    </div>

    <!-- /.col -->
    <div class="col-md-8">
        <div class="box box-danger">
            <div class="box-header with-border">
                <h3 class="box-title">Setting</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="tab-pane" id="settings">
                    <form id="update-user-form" class="form-horizontal snp-profile-form" action="{{ route('profiles.update') }}" method="post">
                        @csrf
                        @include('inc.input-row', [
                            'attr' => 'firstname',
                            'label' => 'First Name',
                            'placeHolder' => 'First Name',
                            'labelCol' => 2,
                            'inputCol' => 10
                        ])
                        @include('inc.input-row', [
                            'attr' => 'lastname',
                            'label' => 'Last Name',
                            'placeHolder' => 'Last Name',
                            'labelCol' => 2,
                            'inputCol' => 10
                        ])
                        <div class="form-group field-gender">
                            <label class="col-lg-2 control-label" for="gender">Gender</label>
                            <div class="col-lg-10">
                                <select class="form-control" name="gender" autocomplete="off">
                                    <option value="{{ User::GENDER_OTHER }}">-</option>
                                    <option {{ $model->gender === User::GENDER_FEMALE ? 'selected="selected"' : null }} value="{{ User::GENDER_FEMALE }}">Nữ</option>
                                    <option {{ $model->gender === User::GENDER_MALE ? 'selected="selected"' : null }} value="{{ User::GENDER_MALE }}">Nam</option>
                                </select>
                            </div>
                            <div class="col-lg-10 snp-fr">
                                <p class="help-block help-block-error"></p>
                            </div>
                        </div>
                        @include('inc.input-row', [
                            'attr' => 'birthday',
                            'value' => viewFormatDate($model->birthday),
                            'label' => 'Date of birth',
                            'placeHolder' => 'Date of birth',
                            'labelCol' => 2,
                            'inputCol' => 10
                        ])
                        @include('inc.input-row', [
                            'attr' => 'phone',
                            'label' => 'Phone',
                            'placeHolder' => 'Phone',
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
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->

<script type="text/javascript">
    $(function(){
            $uploadCrop = $('#preview-upload').croppie({
                enableExif: true,
                viewport: {
                    width: 300,
                    height: 300,
                    type: 'circle'
                },
                boundary: {
                    width: 400,
                    height: 400
                }
            });

            $('#upload').on('change', function () {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#preview-upload').toggleClass('hide');
                    $('.btn-upload').toggleClass('hide');
                    $('.modal-footer').toggleClass('hide');
                    $uploadCrop.croppie('bind', {
                        url: e.target.result
                    }).then(function(){
                        console.log('jQuery bind complete');
                    });
                }
                reader.readAsDataURL(this.files[0]);
            });

            $('.btn-cancal').on('click', function() {
                closePopup();
            });

            $("#change-picture").on("hidden.bs.modal", function () {
                closePopup();
            });

            $('.btn-save').on('click', function (ev) {
                $uploadCrop.croppie('result', {
                    type: 'canvas',
                    size: 'viewport',
                    circle: false
                }).then(function (res) {
                    $.ajax({
                        url: "/profiles/change-avatar",
                        type: "POST",
                        data: {
                            "image":res,
                            "_token": "{{ csrf_token() }}",
                        },
                        success: function (response) {
                            if (response.error) {
                                alert(response.message);
                            } else {
                                $('.js-avatar').attr('src', response.data.path);
                            }
                        }
                    });
                });
            });

            function closePopup() {
                $('#preview-upload').toggleClass('hide');
                $('.btn-upload').toggleClass('hide');
                $('.modal-footer').toggleClass('hide');
                $('#upload').val(null);
            }
        });
</script>
@endsection
