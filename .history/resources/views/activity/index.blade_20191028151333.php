@extends('layout.main')

@section('content')
<link href="{{ asset('assets/css/view-index.css') }}" rel="stylesheet" type="text/css" />
<script src="{{ asset('assets/js/view-index.js') }}"></script>
<script src="{{ asset('assets/js/moment.min.js') }}"></script>
<script src="{{ asset('assets/js/select2.full.min.js') }}"></script>

<div class="box">
	<div class="box-header">
		<h3 class="box-title">Activity</h3>

		<div class="box-tools">
			<div class="pull-right">
				{{--  <a class="btn btn-info mb-2" href="{{ route('hours.create') }}">Tạo khung giờ</a>  --}}
			</div>
		</div>
	</div>
	<!-- /.box-header -->
	<div class="box-body table-responsive">
		<div class="grid-view">
			<table class="table table-striped table-bordered table-search" action="{{ route('activities.index') }}">
				<thead>
					<tr>
						<th>#</th>
						<th><a href="#" data-sort="distance">Distance</a></th>
						<th><a href="#" data-sort="duration">Duration</a></th>
                        <th><a href="#" data-sort="calories">Calories</a></th>
                        <th><a href="#" data-sort="average_pace">Average Pace</a></th>
                        <th><a href="#" data-sort="average_speed">Average Speed</a></th>
                        <th><a href="#" data-sort="max_speed">Max Speed</a></th>
                        <th><a href="#" data-sort="start_time">Start Time</a></th>
                        <th><a href="#" data-sort="date">Date</a></th>
                        {{--  <th><a href="#" data-sort="status"></a></th>  --}}
						<th class="action-column text-center">Action</th>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td><input type="text" class="form-control" name="distance"></td>
                        <td><input type="text" class="form-control" name="duration"></td>
                        <td><input type="text" class="form-control" name="calories"></td>
                        <td><input type="text" class="form-control" name="average_pace"></td>
                        <td><input type="text" class="form-control" name="average_speed"></td>
                        <td><input type="text" class="form-control" name="max_speed"></td>
                        <td><input type="text" class="form-control" name="start_time"></td>
                        <td><input type="text" class="form-control" name="date"></td>
						<td>&nbsp;</td>
					</tr>
				</thead>
				<tbody>
					@foreach($items as $i => $item)
						<tr>
							<td>{{++$i}}</td>
                            <td>{{$item->distance}}</td>
                            <td class="time-format">{{$item->duration}}</td>
                            <td>{{$item->calories}}</td>
                            <td>{{$item->average_pace}}</td>
                            <td>{{$item->average_speed}}</td>
                            <td>{{$item->max_speed}}</td>
                            <td>{{$item->start_time}}</td>
                            <td>{{$item->date}}</td>
							{{--  <td><span class="label label-{{$item->getStatusColor()}}">{{$item->getStatusName()}}</span></td>  --}}
							{{--  <td class="text-center">
								<a href="{{ route('hours.show', $item->id)}}" title="Cập nhật" data-toggle="tooltip" data-original-title="Cập nhật">
									<i class="fa fa-pencil"></i>
								</a>

								<form class="link delete" action="{{ route('hours.destroy', $item->id)}}" method="post">
									@csrf
									@method('DELETE')
									<button class="link" data-toggle="tooltip" data-original-title="Xóa" type="submit">
										<i class="fa fa-trash"></i>
									</button>
								</form>
							</td>  --}}
						</tr>
					@endforeach  
                    {{--  @include('inc.empty', [$items, 'colspan' => 9])  --}}
                </tbody>
			</table>
			{{--  {{ $items->links() }}  --}}
		</div>
	</div>
	<!-- /.box-body -->
</div>
<script>
	$(function() {
		$('.time-format').each(function() {
			$(this).html(moment($(this).html(), "HH:mm:ss").format("HH:mm"))
		})
		$('.select2').select2()
	})
</script>
@endsection
