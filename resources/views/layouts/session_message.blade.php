@php
    $success = Session::get('success');
    $error = Session::get('error');
@endphp

@if (isset($success))
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="btn-close" data-dismiss="alert"></button>
        <strong>Success!</strong> {{ $success }}
    </div>
@endif

@if (isset($error))
    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="btn-close" data-dismiss="alert"></button>
        <strong>Oops!</strong> {{ $error }}
    </div>
@endif

@php
    Session::forget('success');
    Session::forget('error');
@endphp
