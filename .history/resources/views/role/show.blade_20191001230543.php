@extends('layout.main')

@section('content')
<style>
    .con-routes {
        display: flex;
        margin-bottom: 20px;
        height: 300px;
    }
    .con-routes select {
        outline: none;
        border-color: #cecece;
        border-radius: 5px;
        padding: 10px;
    }
    .con-routes select option {
        padding-top: 2px;
        padding-bottom: 2px;
    }
</style>
<div class="box box-info">
    <div class="box-header with-border">
        <h3 class="box-title">Cập nhật role</h3>
    </div>

    @include('inc.error')
    @if($model->getOrder() != 9)
        <form class="form-horizontal" action="{{ route('roles.update', $model->name) }}" method="post">
            @csrf
            @method('PATCH')
            <div class="box-body">
                <div class="form-group">
                    <label class="col-sm-2 control-label">Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="name" value="{{ $model->name }}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Order</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="order" value="{{ $model->getOrder() }}">
                    </div>
                </div>
                <div class="box-footer">
                    <button type="button" class="btn btn-default">Cancel</button>
                    <a href="javascript:void(0)" class="btn btn-info pull-right js-save">Save</a>
                </div>
            </div>
        </form>
    @endif
    <div class="box-body">
        <div class="form-row con-routes">
            <select id="sbOne" class="col-sm-5" multiple="multiple">
                <optgroup class="role" label="Roles">
                    @foreach ($inActiveRoles as $role)
                        <option value="{{$role}}">{{$role}}</option>
                    @endforeach
                </optgroup>
                <optgroup class="permission" label="Permissions">
                    @foreach ($inActivePermissions as $permission)
                        <option value="{{$permission}}">{{$permission}}</option>
                    @endforeach
                </optgroup>
            </select>
            <div class="col-sm-2 text-center">
                <a href="javascript:void(0)" class="btn btn-danger move-left"> << </a>
                <a href="javascript:void(0)" class="btn btn-success move-right"> >> </a>
            </div>
            <select id="sbTwo" class="col-sm-5" name="items[]" multiple="multiple">
                <optgroup class="role" label="Roles">
                    @foreach ($activeRoles as $role)
                        <option value="{{$role}}">{{$role}}</option>
                    @endforeach
                </optgroup>
                <optgroup class="permission" label="Permissions">
                    @foreach ($activePermissions as $permission)
                        <option value="{{$permission}}">{{$permission}}</option>
                    @endforeach
                </optgroup>
            </select>
        </div>
    </div>
</div>

<script>
    $(function () {
        $(document).on('click', '.js-save', function() {
            $('form').submit();
        })

        function moveItems(origin, dest, action) {
            var items = [];

            $(origin + ' option:selected').each(function() {
                if($(this).parent().hasClass('permission')) {
                    items.push({child: this.value, child_type: 1});
                } else {
                    items.push({child: this.value, child_type: 2});
                }
            });

            $.ajax({
                url: '/item-child/' + action + '/{{ $model->name }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    items: items,
                },
                success: function(res) {
                    if (res.success) {
                        $(origin).find('optgroup.permission :selected').appendTo(dest + ' optgroup.permission')
                        $(origin).find('optgroup.role :selected').appendTo(dest + ' optgroup.role')
                    } else {
                        alert(res.message);
                    }
                }
            });
        }

        $('.move-left').click(function () {
            moveItems('#sbTwo', '#sbOne', 'remove');
        });

        $('.move-right').on('click', function () {
            moveItems('#sbOne', '#sbTwo', 'add');
        });
    });
</script>
@endsection
