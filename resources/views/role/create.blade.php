@extends('layout.main')

@section('content')
<div class="box box-info">
	<div class="box-header with-border">
		<h3 class="box-title">Create Role</h3>
	</div>

	@include('inc.error')

	<form class="form-horizontal" action="{{ route('roles.store') }}" method="post">
		@csrf
		<div class="box-body">
			<div class="form-group">
				<label class="col-sm-2 control-label">Name</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" name="name">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">Order</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" name="order">
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
