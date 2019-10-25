@if ($message = Session::get('success'))
    <div class="alert alert-success alert-block">
        <strong>Success!</strong> {{ $message }}
        <button type="button" class="close" data-dismiss="alert">×</button>
    </div>
@endif

@if ($message = Session::get('error'))
    <div class="alert alert-danger alert-block">
        <strong>Error!</strong> {{ $message }}
        <button type="button" class="close" data-dismiss="alert">×</button>
    </div>
@endif

@if ($message = Session::get('warning'))
    <div class="alert alert-warning alert-block">
        <strong>Warning!</strong> {{ $message }}
        <button type="button" class="close" data-dismiss="alert">×</button>
    </div>
@endif

@if ($message = Session::get('info'))
    <div class="alert alert-info alert-block">
        <strong>Success!</strong> {{ $message }}
        <button type="button" class="close" data-dismiss="alert">×</button>
    </div>
@endif
