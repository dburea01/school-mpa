@if(Session::has('success'))
<div class="alert alert-success alert-dismissible">
    {{ Session::get('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">&nbsp;</button>
    @php
    Session::forget('success');
    @endphp
</div>
@endif

@if(Session::has('error'))
<div class="alert alert-danger alert-dismissible">
    {{ Session::get('error') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">&nbsp;</button>
    @php
    Session::forget('error');
    @endphp
</div>
@endif

@if(Session::has('warning'))
<div class="alert alert-warning alert-dismissible">
    {{ Session::get('warning') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">&nbsp;</button>
    @php
    Session::forget('warning');
    @endphp
</div>
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