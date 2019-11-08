@extends('layout.main')

@section('content')
<link href="{{ asset('assets/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet" type="text/css" />
<script src="{{ asset('assets/js/moment.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap-datetimepicker.min.js') }}"></script>
<script src="{{ asset('assets/js/select2.full.min.js') }}"></script>
<div class="box box-info">
	<div class="box-header with-border">
		<h3 class="box-title">Tạo mã giảm giá</h3>
	</div>

	@include('inc.error')

	<form class="form-horizontal" action="{{ route('hours.store') }}" method="post">
		@csrf
		<div class="box-body">
			<div class="form-group">
				<label class="col-sm-2 control-label">Thời gian</label>
				<div class="col-sm-10">
					<input type="text" class="form-control datetime" name="time">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">Số lượng xe</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" name="car_amount" maxlength="32">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">Trạng thái</label>
				<div class="col-sm-10">
					<select class="form-control select2" name="status">
						<option selected="selected" value="1">Active</option>
						<option value="0">In-Active</option>
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
		$('.datetime').datetimepicker({
			format: 'HH:mm',
			stepping: 30,
			collapse: false,
			sideBySide: true,
			showClose: true,
			defaultDate: 'now',
		});

		$('.select2').select2()
	});
</script>
@endsection
