@extends('layout.main')

@section('content')
<link href="{{ asset('assets/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet" type="text/css" />
<script src="{{ asset('assets/js/moment.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap-datetimepicker.min.js') }}"></script>
<script src="{{ asset('assets/js/select2.full.min.js') }}"></script>

<div class="box box-info">
	<div class="box-header with-border">
		<h3 class="box-title">Cập nhật bài viết</h3>
	</div>

	@include('inc.error')

	<form class="form-horizontal" action="{{ route('activities.update', $model->id) }}" method="post">
		@csrf
		@method('PATCH')
		<div class="box-body">
			<div class="form-group">
				<label class="col-sm-2 control-label">Distance</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" name="distance" value="{{ $model->distance }}">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">Duration</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" name="duration" value="{{ $model->duration }}">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">Calories</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" name="calories" value="{{ $model->calories}}">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">Average Pace</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" name="average_pace" value="{{ $model->average_pace }}">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">Average Speed</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" name="average_speed" value="{{ $model->average_speed }}">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">Max Speed</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" name="max_speed" value="{{ $model->max_speed }}">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">Start Time</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" name="start_time" value="{{ $model->start_time }}">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">Date</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" name="date" value="{{ $model->date }}">
				</div>
			</div>
			<div class="box-footer">
				<button type="button" class="btn btn-default">Cancel</button>
				<button type="submit" class="btn btn-info pull-right">Save</button>
			</div>
		</div>
	</form>
</div>
<script type="text/javascript">
	$(function () {
		$('.datetime').datetimepicker({
			format: 'HH:mm',
			stepping: 30,
			collapse: false,
			sideBySide: true,
			showClose: true,
		});

		$('.select2').select2()
	});
</script>
@endsection
