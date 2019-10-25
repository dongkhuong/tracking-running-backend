@extends('layout.main')

@section('content')
<link href="{{ asset('assets/css/view-index.css') }}" rel="stylesheet" type="text/css" />
<script src="{{ asset('assets/js/view-index.js') }}"></script>

<div class="box">
	<div class="box-header">
		<h3 class="box-title">Quản lý User</h3>

		<div class="box-tools">
			<div class="pull-right">
				<a class="btn btn-info mb-2" href="{{ route('users.create')}}">Tạo mới</a>
			</div>
		</div>
	</div>
	<!-- /.box-header -->
	<div class="box-body table-responsive">
		<div class="grid-view">
			<table class="table table-striped table-bordered table-search" action="{{ route('users.index') }}">
				<thead>
					<tr>
						<th>#</th>
						<th><a href="#" data-sort="lastname">Họ </a></th>
						<th><a href="#" data-sort="firstname">Tên</a></th>
						<th><a href="#" data-sort="email">Email</a></th>
						<th><a href="#" data-sort="birthday">Ngày sinh</a></th>
						<th><a href="#" data-sort="phone">Số điện thoại</a></th>
						<th><a href="#" data-sort="status">Trạng thái</a></th>
						<th><a href="#" data-sort="status">Quyền</a></th>
						<th class="action-column text-center">Action</th>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td><input type="text" class="form-control" name="lastname"></td>
						<td><input type="text" class="form-control" name="firstname"></td>
						<td><input type="text" class="form-control" name="email"></td>
						<td><input type="text" class="form-control" name="birthday" placeholder="dd-mm-yyyy"></td>
						<td><input type="text" class="form-control" name="phone"></td>
						<td>
                            <select class="form-control" name="status">
                                <option value="">All</option>
                                <option value="10">Active</option>
                                <option value="0">In-Active</option>
                            </select>
                        </td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
					</tr>
				</thead>
				<tbody>
					@foreach($items as $i => $item)
						<tr>
							<td>{{++$i}}</td>
							<td>{{$item->lastname}}</td>
							<td>{{$item->firstname}}</td>
							<td>{{$item->email}}</td>
							<td>{{viewFormatDate($item->birthday)}}</td>
							<td>{{$item->phone}}</td>
							<td><span class="label label-{{$item->getStatusLabel()}}">{{$item->getStatusName()}}</span></td>
                            <td>{{$item->role->item_name}}</td>
							<td class="text-center" style="width:70px">
								<a href="{{ route('users.show', $item->id)}}" title="Cập nhật" data-toggle="tooltip" data-original-title="Cập nhật">
									<i class="fa fa-pencil"></i>
								</a>

								<form class="link delete" action="{{ route('users.destroy', $item->id)}}" method="post">
									@csrf
									@method('DELETE')
									<button class="link" data-toggle="tooltip" data-original-title="Xóa" type="submit">
										<i class="fa fa-trash"></i>
									</button>
								</form>
							</td>

						</tr>
					@endforeach

                    @include('inc.empty', [$items, 'colspan' => 9])
				</tbody>
			</table>
			{{ $items->links() }}
		</div>
	</div>
	<!-- /.box-body -->
</div>
@endsection
