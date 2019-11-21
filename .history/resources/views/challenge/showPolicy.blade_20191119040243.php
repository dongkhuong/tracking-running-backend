@extends('layout.main')

@section('content')
<link href="{{ asset('assets/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet" type="text/css" />
<script src="{{ asset('assets/js/moment.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap-datetimepicker.min.js') }}"></script>
<script src="{{ asset('assets/js/select2.full.min.js') }}"></script>

<div class="box box-info">
	@if (isset($policy))
		<div class="box-header with-border">
			<h3 class="box-title">Update Challenge</h3>
		</div>
	@else 
		<div class="box-header with-border">
			<h3 class="box-title">Create Policy</h3>
		</div>
	@endif
	@include('inc.error')
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
