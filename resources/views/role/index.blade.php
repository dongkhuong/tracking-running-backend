@extends('layout.main')

@section('content')
<link href="{{ asset('assets/css/view-index.css') }}" rel="stylesheet" type="text/css" />
<script src="{{ asset('assets/js/view-index.js') }}"></script>

<div class="box">
	<div class="box-header">
		<h3 class="box-title">Role</h3>

		<div class="box-tools">
			<div class="pull-right">
				<a class="btn btn-info mb-2" href="{{ route('roles.create') }}">Tạo Role</a>
			</div>
		</div>
	</div>
	<!-- /.box-header -->
	<div class="box-body table-responsive">
		<div class="grid-view">
			<table class="table table-striped table-bordered table-search" action="{{ route('roles.index') }}">
				<thead>
					<tr>
						<th>#</th>
						<th><a href="#" data-sort="name">Name</a></th>
						<th><a href="#" data-sort="name">Order</a></th>
						<th class="action-column text-center">Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach($items as $i => $item)
						<tr>
							<td>{{++$i}}</td>
							<td>{{$item->name}}</td>
							<td>{{$item->getOrder()}}</td>
							<td class="text-center">
                                @if($item->getOrder() != 0)
                                    <a href="{{ route('roles.show', $item->name)}}" title="Cập nhật" data-toggle="tooltip" data-original-title="Cập nhật">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                    @if($item->getOrder() != 9)
                                        <form class="link delete" action="{{ route('roles.destroy', $item->name)}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button class="link" data-toggle="tooltip" data-original-title="Xóa" type="submit">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    @endif
                                @endif
							</td>
						</tr>
					@endforeach

					@include('inc.empty', [$items, 'colspan' => 3])
				</tbody>
			</table>
		</div>
	</div>
	<!-- /.box-body -->
</div>
@endsection
