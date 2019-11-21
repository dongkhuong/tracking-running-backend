@extends('layout.main')

@section('content')
<link href="{{ asset('assets/css/view-index.css') }}" rel="stylesheet" type="text/css" />
<script src="{{ asset('assets/js/view-index.js') }}"></script>
<script src="{{ asset('assets/js/moment.min.js') }}"></script>
<script src="{{ asset('assets/js/select2.full.min.js') }}"></script>

<div class="box">
	<div class="box-header">
		<h3 class="box-title">Challenges</h3>

		<div class="box-tools">
			<div class="pull-right">
				<a class="btn btn-info mb-2" href="{{ route('challenges.create') }}">Create Challenge</a>
			</div>
		</div>
	</div>
	<!-- /.box-header -->
	<div class="box-body table-responsive">
		<div class="grid-view">
			<table class="table table-striped table-bordered table-search" action="{{ route('challenges.index') }}">
				<thead>
					<tr>
						<th>#</th>
						<th><a href="#" data-sort="name">Name</a></th>
						<th><a href="#" data-sort="description">Description</a></th>
                        <th><a href="#" data-sort="start_date">Start Date</a></th>
                        <th><a href="#" data-sort="end_date">End Date</a></th>
                        <th><a href="#" data-sort="start_time">Start Time</a></th>
                        <th><a href="#" data-sort="goal">Goal</a></th>
                        <th><a href="#" data-sort="image">Image</a></th>
                        <th><a href="#" data-sort="group_name">Group Name</a></th>
                        <th><a href="#" data-sort="group_name">Policy</a></th>
                        <th class="action-column text-center">Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach($items as $i => $item)
						<tr>
							<td>{{++$i}}</td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->description}}</td>
                            <td>{{$item->start_date}}</td>
                            <td>{{$item->end_date}}</td>
                            <td>{{$item->start_time}}</td>
                            <td>{{$item->goal}}</td>
                            <td>{{$item->image}}</td>
                            <td>{{$item->group->name}}</td>
                            <td>
                                <a href="{{ route('challenges.showPolicy', $item->id)}}" title="Cập nhật" data-toggle="tooltip" data-original-title="Cập nhật">
                                    <i class="fa fa-view"></i>
                                </a>        
                            </td>
							<td class="text-center">
								<a href="{{ route('challenges.show', $item->id)}}" title="Cập nhật" data-toggle="tooltip" data-original-title="Cập nhật">
									<i class="fa fa-pencil"></i>
								</a>

								<form class="link delete" action="{{ route('challenges.destroy', $item->id)}}" method="post">
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
