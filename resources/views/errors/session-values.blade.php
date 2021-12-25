@if(Session::has('success'))

<div class="toast align-items-center bg-success text-white" role=" alert" aria-live="assertive" aria-atomic="true">
    <div class="d-flex">
        <div class="toast-body">
            {{ Session::get('success') }}
        </div>
        <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
</div>

@php
Session::forget('success');
@endphp
@endif

@if(Session::has('error'))

<div class="toast align-items-center bg-danger text-white" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="d-flex">
        <div class="toast-body">
            {{ Session::get('error') }}
        </div>
        <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
</div>

@php
Session::forget('error');
@endphp
@endif

@if(Session::has('warning'))
<div class="toast align-items-center bg-warning text-white" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="d-flex">
        <div class="toast-body">
            {{ Session::get('warning') }}
        </div>
        <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
</div>

@php
Session::forget('warning');
@endphp
@endif

@if ($errors->any())
<div class="alert alert-danger alert-dismissible">
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">&nbsp;</button>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif