@extends('layout.main')

@section('content')
<link href="{{ asset('assets/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet" type="text/css" />
<script src="{{ asset('assets/js/moment.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap-datetimepicker.min.js') }}"></script>
<script src="{{ asset('assets/js/select2.full.min.js') }}"></script>

<div class="box box-info">
	@if (isset($model))
		<div class="box-header with-border">
			<div class="row">
				<h3 class="box-title" style="margin-left: 20px">Update Policy</h3>
				<form style="margin-right: 30px" class="link delete pull-right" action="{{ route('challenges.deletePolicy', $model->id)}}" method="post">
					@csrf
					@method('DELETE')
					<button class="btn btn-danger" data-toggle="tooltip" data-original-title="Xóa" type="submit">
						<i class="fa fa-info"></i>
					</button>
				</form>
			</div>
			@include('inc.error')
				<form class="form-horizontal" action="{{ route('challenges.updatePolicy', $model->id) }}" method="post">
					@csrf
					@method('PATCH')
					<div class="box-body">
						<div class="form-group">
							<label class="col-sm-2 control-label">Overview</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="overview" value="{{ $model->overview }}" required>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Reward</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="rewards" value="{{ $model->rewards }}" required>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Additional Info</label>
							<div class="col-sm-10">
								<input type="text" class="form-control date" name="add_infos" value="{{ $model->add_infos }}" required>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Rules</label>
							<div class="col-sm-10">
								<input type="text" class="form-control date" name="rules" value="{{ $model->rules }}" required>
							</div>
						</div>
						<div class="box-footer">
							<button type="button" class="btn btn-default">Cancel</button>
							<button type="submit" class="btn btn-info pull-right">Save</button>
						</div>
					</div>
				</form> 
		</div>
	@else 
	  <div class="box-header with-border">
			<h3 class="box-title">Create Policy</h3>
			@include('inc.error')
			<form class="form-horizontal" action="{{ route('challenges.createPolicy', request()->route('challenge_id')) }}" method="post">
				@csrf
				@method('POST')
				<div class="box-body">
					<div class="form-group">
						<label class="col-sm-2 control-label">Overview</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="overview" required>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Reward</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="rewards" required>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Additional Info</label>
						<div class="col-sm-10">
							<input type="text" class="form-control date" name="add_infos" required>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Rules</label>
						<div class="col-sm-10">
							<input type="text" class="form-control date" name="rules" required>
						</div>
					</div>
					<div class="box-footer">
						<button type="button" class="btn btn-default">Cancel</button>
						{{--  <button type="button" class="btn btn-danger pull-right">Delete</button>  --}}
						<button type="submit" class="btn btn-info pull-right">Save</button>
					</div>
				</div>
			</form> 
		</div> 
	
	@endif
</div>
{{--  <script type="text/javascript">
	$(function () {
		$('.time').datetimepicker({
			format: 'HH:mm',
			stepping: 30,
			collapse: false,
			sideBySide: true,
			showClose: true,
			defaultDate: 'now',
		});

        $('.select2').select2()

        $('.date').datetimepicker({
			format: 'YYYY-MM-DD',
			stepping: 30,
			collapse: false,
			sideBySide: true,
			showClose: true,
			defaultDate: 'now',
			minDate: 'now'
		});

		$('.select2').select2()

	});
</script>  
--}}
@endsection
