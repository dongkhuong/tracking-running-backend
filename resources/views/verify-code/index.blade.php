@extends('layout.main')

@section('content')
<link href="{{ asset('assets/css/view-index.css') }}" rel="stylesheet" type="text/css" />
<script src="{{ asset('assets/js/view-index.js') }}"></script>

<div class="box">
	<div class="box-header">
		<h3 class="box-title">Verify Codes</h3>
	</div>
	<!-- /.box-header -->
	<div class="box-body table-responsive">
		<div class="grid-view">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th><a href="#" data-sort="phone">{{__('verifyCode.phone')}}</a></th>
                            <th><a href="#" data-sort="code">{{__('verifyCode.code')}}</a></th>
                            <th><a href="#" data-sort="mac_address">{{__('verifyCode.mac_address')}}</a></th>
                            <th><a href="#" data-sort="device_name">{{__('verifyCode.device_name')}}</a></th>
                            <th><a href="#" data-sort="status">{{__('verifyCode.status')}}</a></th>
                            <th><a href="#" data-sort="expired_at">{{__('verifyCode.expired_at')}}</a></th>
                            <th class="action-column text-center">{{__('verifyCode.action')}}</th>
                        </tr>
                        <tr>
                            <form id="js-form" class="form-horizontal dropzone" action="{{ route('verify-codes.index') }}" method="get">
                                <td>&nbsp;</td>
                                <td><input type="text" class="form-control" name="phone" value="{{request()->phone}}"></td>
                                <td><input type="text" class="form-control" name="code" value="{{request()->code}}"></td>
                                <td><input type="text" class="form-control" name="mac_address" value="{{request()->mac_address}}"></td>
                                <td><input type="text" class="form-control" name="device_name" value="{{request()->device_name}}"></td>
                                <td>
                                    <select name="is_block" class="form-control">
                                        <option></option>
                                        <option value="1" {{request()->is_block ? 'selected' : ''}}>{{__('verifyCode.blocked')}}</option>
                                        <option value="0" {{request()->is_block == '0' ? 'selected' : ''}}>{{__('verifyCode.available')}}</option>
                                    </select>
                                </td>
                                
                                {{-- <td><input type="text" class="form-control" name="created_at"></td>
                                <td><input type="text" class="form-control" name="updated_at"></td> --}}
                                <td></td>
                                <td>&nbsp;</td>
                            </form>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($items as $i => $item)
                            <tr>
                                <td>{{++$i}}</td>
                                <td>{{$item->phone}}</td>
                                <td class="js-code" data-id="{{$item->id}}">{{$item->code}}</td>
                                <td>{{$item->deviceBlock->mac_address}}</td>
                                <td>{{$item->deviceBlock->device_name}}</td>
                                <td class="js-is-block" data-id="{{$item->id}}">
                                    @if ($item->deviceBlock->is_block == 1)
                                    {{__('verifyCode.blocked')}}
                                    @else 
                                    {{__('verifyCode.available')}}
                                    @endif
                                </td>
                                
                                <td class="js-expired-at" data-id="{{$item->id}}">{{$item->expired_at}}</td>
                                <td class="text-center">
                                    <button href="#" class="btn btn-verify-code-renew" title="Renew" data-id="{{$item->id}}" data-toggle="tooltip" data-original-title="Renew">
                                            {{__('verifyCode.renew')}}
                                    </button>

                                    <form class="link delete" action="{{ route('verify-codes.destroy', $item->id)}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="link" data-toggle="tooltip" data-original-title="Xóa" type="submit">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        @if (count($items) == 0)
                        <tr>
                            <td colspan="6">
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
<script>
$('.btn-verify-code-renew').on('click', function (ev) {
    let id = ev.target.getAttribute('data-id');
    $.ajax({
        url: "/verify-codes/" + id,
        type: 'PATCH',
        data: {
            "_token": "{{ csrf_token() }}",
        },
        success: function (response) {
            if (response.error) {
                alert(response.message);
            } else {
                let data = response.data;
                $('.js-code[data-id="' + id + '"]').html(data['code']);
                $('.js-is-block[data-id="' + id + '"]').html(response.message);
                $('.js-expired-at[data-id="' + id + '"]').html(data['expired_at']);
            }
        }
    });
});

document.onkeyup = function(e) {
  if (e.keyCode === 13) {
    document.getElementById('js-form').submit();
  }
  
  return true;
 }
</script>
@endsection
