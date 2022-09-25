@extends('layouts.app_layout')
@section('title', __('titles.assignments'))
@section('content')
<div class="row">
    <div class="col mx-auto">
        @include('errors.session-values')
    </div>
</div>

<h1 class="text-center">@lang('assignments.title') <span class="text-primary">{{ $classroom->name }}</span></h1>


<div class="row mt-3">
    <div class="col-md-8 mx-auto">
        <form class="row row-cols-lg-auto g-3 align-items-center mb-3"
            action="/schools/{{$school->id}}/classrooms/{{$classroom->id}}/assignments" method="POST">
            @csrf
            <div class="col-md-4">
                <label class="visually-hidden" for="userName">@lang('assignments.search_user')</label>
                <input class="form-control form-control-sm" id="userName" name="userName" value="" type="text"
                    placeholder="@lang('assignments.search_user')">
                <input type="hidden" id="userIdToAssign" name="userIdToAssign" value="">
                @if ($errors->has('userIdToAssign'))
                <span class="text-danger">{{ $errors->first('userIdToAssign') }}</span>
                @endif
            </div>

            <button type="submit" class="btn btn-sm btn-success"><i class="bi bi-plus-circle" aria-hidden="true"></i>
                @lang('assignments.assign')</button>
        </form>
    </div>
</div>

<div class="row">
    <div class="col-md-8 mx-auto">
        <table class="table table-sm table-striped table-bordered table-hover" aria-label="List of assignments">


            @foreach ($assignments as $assignment)
            <tr>
                <td>
                    <a href="/schools/{{ $school->id }}/users/{{ $assignment->user->id }}/edit">{{
                        $assignment->user->fullName }}</a>
                    @if ($assignment->user->status === 'INACTIVE')
                    <x-alert-user-inactive />
                    @endif
                </td>
                <td>
                    {{ $assignment->user->birth_date }}
                </td>
                <td>
                    {{ $assignment->user->age() }}
                </td>
                <td>
                    @switch($assignment->user->gender_id)
                    @case(1)
                    <i class="bi bi-gender-male" aria-hidden="true"></i>
                    @break
                    @case(2)
                    <i class="bi bi-gender-female" aria-hidden="true"></i>
                    @break
                    @default
                    <i class="bi bi-question" aria-hidden="true"></i>
                    @endswitch

                </td>
                <td>
                    <form action="/schools/{{ $school->id }}/classrooms/{{ $classroom->id }}/
                            assignments/{{ $assignment->id }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" aria-label="add"
                            title="@lang('assignments.delete_assignment')">
                            <i class="bi bi-trash" aria-hidden="true"></i> </button>
                    </form>
                </td>
            </tr>
            @endforeach

        </table>


    </div>

    <div class="col-md-2 mx-auto">



        <table class="table table-sm table-bordered table-hover" aria-label="List of assignments">
            <tr>
                <th>@lang('assignments.students_male')</th>
                <td>{{ $qtyBoys }}</td>
            </tr>
            <tr>
                <th>@lang('assignments.students_female')</th>
                <td>{{ $qtyGirls }}</td>
            </tr>
            <tr>
                <th>@lang('assignments.students_total')</th>
                <td>{{$assignments->count() }}</td>
            </tr>

        </table>
    </div>


</div>



@endsection

@section('extra_js')
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"
    integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>

<script>
    $(document).ready(function(){

    $( "#userName" ).autocomplete({
        source: function(request, response) {
            
            $.ajax({
                url: "/schools/{{$school->id}}/users/autocomplete",
                data: {
                    search : request.term
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                
                dataType: "json",
                
                success: function(data){
                    
                    var resp = $.map(data,function(user){
                        
                        return {
                            value:user.last_name+' '+user.first_name,
                            id:user.id
                        }
                    })
                    response(resp);
                }
            });
        },
        minLength: 1,
        select: function (event, ui) {
            $('#userIdToAssign').val(ui.item.id)
        }
    });

});
</script>
@endsection
