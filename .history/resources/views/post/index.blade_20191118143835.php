@extends('layout.main')

@section('content')
<link href="{{ asset('assets/css/view-index.css') }}" rel="stylesheet" type="text/css" />
<script src="{{ asset('assets/js/view-index.js') }}"></script>

<div class="box">
	<div class="box-header">
		<h3 class="box-title">Posts</h3>
	</div>
	<!-- /.box-header -->
	<div class="box-body table-responsive">
		<div class="grid-view">
			<table class="table table-striped table-bordered table-search" action="{{ route('posts.index') }}">
				<thead>
					<tr>
						<th>#</th>
						<th><a href="#" data-sort="content">Content</a></th>
						<th><a href="#" data-sort="image">Image</a></th>
						<th><a href="#" data-sort="user">User</a></th>
						<th class="action-column text-center">Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach($items as $i => $item)
						<tr>
							<td>{{++$i}}</td>
							<td>{{$item->content}}</td>
							<td>{{$item->image}}</td>
							<td>{{$item->user->firstname.''.$item->user->lastname}}</td>
							<td class="text-center">
								<form class="link delete" action="{{ route('posts.destroy', $item->id)}}" method="post">
									@csrf
									@method('DELETE')
									<button class="link" data-toggle="tooltip" data-original-title="Xóa" type="submit">
										<i class="fa fa-trash"></i>
									</button>
								</form>
							</td>
						</tr>
					@endforeach
					@if($items->isEmpty())
						<tr>
							<td colspan="3">
								<div class="empty">No results found.</div>
							</td>
						</tr>
					@endif
				</tbody>
			</table>
			{{ $items->links() }}
		</div>
	</div>
	<!-- /.box-body -->
</div>
@endsection
