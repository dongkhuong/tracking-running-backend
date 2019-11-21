@extends('layout.main')

@section('content')
<link href="{{ asset('assets/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet" type="text/css" />
<script src="{{ asset('assets/js/moment.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap-datetimepicker.min.js') }}"></script>
<script src="{{ asset('assets/js/select2.full.min.js') }}"></script>

<div class="box box-info">
	<div class="box-header with-border">
		<h3 class="box-title">Update Challenge</h3>
	</div>

	@include('inc.error')

	<form class="form-horizontal" action="{{ route('challenges.update', $model->id) }}" method="post">
		@csrf
		@method('PATCH')
		<div class="box-body">
			<div class="form-group">
				<label class="col-sm-2 control-label">Name</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" name="name" value="{{ $model->name }}">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">Description</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" name="description" value="{{ $model->description }}">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">Start Date</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" name="start_date" value="{{ $model->start_date }}">
				</div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">End Date</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="end_date" value="{{ $model->end_date }}">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Start Time</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="start_time" value="{{ $model->start_time }}">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Goal</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="goal" value="{{ $model->goal }}">
                </div>
            </div>
			<div class="box-footer">
				<button type="button" class="btn btn-default">Cancel</button>
				<button type="submit" class="btn btn-info pull-right">Save</button>
			</div>
		</div>
	</form>
</div>
@endsection
