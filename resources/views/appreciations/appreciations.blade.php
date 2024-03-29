@extends('layouts.app_layout')
@section('title', __('titles.subjects'))
@section('content')

@include('errors.session-values')

<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">



<h1 class="text-center">@lang('appreciations.title') ({{$appreciations->count()}})&nbsp;
    <a href="/appreciations/create" class="btn btn-primary btn-sm"><i class="bi bi-plus-circle" aria-hidden="true"></i>
        @lang('appreciations.add')</a>
</h1>


<div class="row">
    <div class="col">

        {{--
        <table class="table table-sm table-striped table-bordered table-hover" aria-label="List of the appreciations">
            <thead>
                <tr>
                    <th>@lang('appreciations.short_name')</th>
                    <th>@lang('appreciations.position')</th>
                    <th>@lang('appreciations.name')</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($appreciations as $appreciation)
                <tr>
                    <td>
                        <a href="/appreciations/{{ $appreciation->id }}/edit">{{
                            $appreciation->short_name }}</a>
                        @if ($appreciation->status === 'INACTIVE')
                        <i class="bi bi-exclamation-triangle-fill text-danger" aria-hidden="true"
                            title="@lang('appreciations.appreciation_inactive')"></i>
                        @endif

                        @if($appreciation->comment)
                        <i class="bi bi-card-text" aria-hidden="true" data-bs-toggle="tooltip" data-bs-placement="right"
                            data-bs-title="{{ $appreciation->comment }}"></i>
                        @endif
                    </td>
                    <td>{{ $appreciation->position }}</td>
                    <td>{{ $appreciation->name }}</td>
                </tr>
                @endforeach
            </tbody>

        </table>
        --}}

        <div id="sortable">
            @foreach ($appreciations as $appreciation)
            <div class="row ui-state-default p-3" id="shortname_{{ $appreciation->id }}">
                <span><i class="bi bi-arrow-down-up" aria-hidden="true"></i>&nbsp;
                    <a href="/appreciations/{{ $appreciation->id }}/edit" class="btn btn-sm">{{
                        $appreciation->name }}</a>
                    @if ($appreciation->status === 'INACTIVE')
                    <i class="bi bi-exclamation-triangle-fill text-danger" aria-hidden="true"
                        title="@lang('appreciations.appreciation_inactive')"></i>
                    @endif

                    @if($appreciation->comment)
                    <i class="bi bi-card-text" aria-hidden="true" data-bs-toggle="tooltip" data-bs-placement="right"
                        data-bs-title="{{ $appreciation->comment }}"></i>
                    @endif
                </span>
            </div>
            @endforeach
        </div>



    </div>

</div>

<div class="toast bg-success text-white" id="myToast" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-body">
        @lang('appreciations.sorted_successfully')
    </div>
</div>

@endsection






@section('extra_js')
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"
    integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>

<script>
    $(document).ready(function(){

        $( "#sortable" ).sortable({
            update: function( event, ui ) {
                let order = $(this).sortable('serialize');
                
                $.ajax({
                url: "/appreciations/sort",
                method: "POST",
                data: {order : order},
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                dataType: "json",
                statusCode: {
                    200: function() {
                        // alert( "appreciations sorted." );
                        var myAlert =document.getElementById('myToast');//select id of toast
          var bsAlert = new bootstrap.Toast(myAlert);//inizialize it
          bsAlert.show();//show it
                    }
                }
            });
            }
        });
    });
</script>

@endsection
