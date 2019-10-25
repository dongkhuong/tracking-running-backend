@extends('layout.main')

@section('content')
<div class="box box-info">
	<div class="box-header with-border">
		<h3 class="box-title">{{ trans('label.user.update') }}</h3>
	</div>

	@include('inc.error')

    <form action="{{ route('users.update', $model->id) }}" method="post">
        <div class="box-body">
            @csrf
            @method('PATCH')
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>{{ trans('label.user.firstname') }}</label>
                    <input type="text" class="form-control" name="firstname" placeholder="{{ trans('label.user.firstname') }}" value="{{ old('firstname', $model->firstname) }}">
                </div>
                <div class="form-group col-md-6">
                    <label>{{ trans('label.user.lastname') }}</label>
                    <input type="text" class="form-control" name="lastname" placeholder="{{ trans('label.user.lastname') }}" value="{{ old('lastname', $model->lastname) }}">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputAddress">{{ trans('label.user.birthday') }}</label>
                    <input type="text" class="form-control" name="birthday" placeholder="{{ trans('label.user.birthday') }}" value="{{ old('birthday', viewFormatDate($model->birthday)) }}">
                </div>
                <div class="form-group col-md-6">
                    <label>Email</label>
                    <input type="email" class="form-control" name="email" placeholder="Email" value="{{ old('email', $model->email) }}">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>{{ trans('label.user.phone') }}</label>
                    <input type="text" class="form-control" name="phone" placeholder="{{ trans('label.user.phone') }}" value="{{ old('phone', $model->phone) }}">
                </div>
                <div class="form-group col-md-6">
                    <label>{{ trans('label.user.status') }}</label>
                    <select class="form-control select2" name="status">
						<option {{ $model->status==10 ? 'selected="selected"' : null }} value="10">Active</option>
						<option {{ $model->status==0 ? 'selected="selected"' : null }} value="0">In-Active</option>
					</select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label>{{ trans('label.user.role') }}</label>
                    <select class="form-control" name="role">
                        @foreach($roles as $role)
                            <option {{ $model->role->item_name == $role ? 'selected="selected"' : null }} value="{{$role}}">{{$role}}</option>
                        @endforeach
					</select>
                </div>
            </div>
            <a href="{{ route('users.index') }}" class="btn btn-default">{{ trans('label.common.cancel') }}</a>
            <button type="submit" class="btn btn-primary">{{ trans('label.common.update') }}</button>
        </div>
    </form>
</div>
@endsection
