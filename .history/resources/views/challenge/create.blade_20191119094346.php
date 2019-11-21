@extends('layout.main')

@section('content')
<link href="{{ asset('assets/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet" type="text/css" />
<script src="{{ asset('assets/js/moment.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap-datetimepicker.min.js') }}"></script>
<script src="{{ asset('assets/js/select2.full.min.js') }}"></script>
<div class="box box-info">
	<div class="box-header with-border">
		<h3 class="box-title">Create Challenge</h3>
	</div>

	@include('inc.error')

	<form class="form-horizontal" action="{{ route('challenges.store') }}" method="post">
		@csrf
		<div class="box-body">
			<div class="form-group">
				<label class="col-sm-2 control-label">Name</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" name="name" required>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">Description</label>
				<div class="col-sm-10">
					<textarea id="js-content" class="form-control" name="description" ></textarea>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">Start Date</label>
				<div class="col-sm-10">
					<input type="text" class="form-control date" name="start_date" required>
				</div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">End Date</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control date" name="end_date" required>
                </div>
                </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Start Time</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control time" name="start_time" required>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Goal</label>
                <div class="col-sm-10">
                    <input type="number" step=0.01 class="form-control" name="goal" required>
                </div>
            </div>
            <div class="form-group">
                    <label class="col-sm-2 control-label" for="group_id">Group</label>
                    <div class="col-sm-10">
                        <select class="form-control select2" name="group_id" required>
                            @foreach($groups as $i => $item)
                                <option value={{$item->id}}>{{$item->name}}</option>
                            @endforeach
                        </select>
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
		$('.time').datetimepicker({
			format: 'HH:mm',
			stepping: 30,
			collapse: false,
			sideBySide: true,
			showClose: true,
			defaultDate: 'now',
        });
        
        $('.select2').select2();

        $('.date').datetimepicker({
			format: 'YYYY-MM-DD',
			stepping: 30,
			collapse: false,
			sideBySide: true,
			showClose: true,
			defaultDate: 'now',
			minDate: 'now'
		});
	});
</script>
@endsection
