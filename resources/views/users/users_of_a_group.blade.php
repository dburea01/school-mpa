@extends('layouts.layout_with_menu_sidebar')

@section('content')
<div class="row">
    <div class="col mx-auto">
        @include('errors.session-values')
    </div>
</div>

<h2 class="text-center mb-3">@if ($group->id) @lang('group.modify_group') @else @lang('group.create_group') @endif</h2>

<x-group-tabs activeTab="parents" schoolId="{{ $school->id }}" groupId="{{ $group->id }}" />

<div class="row">
    <div class="col">

        <div class="card">
            <div class="card-header">@lang('group.users_of_a_group')</div>
            <div class="card-body">
                <table class="table table-sm table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>@lang('group.user_name_of_a_group')</th>
                            <th>@lang('group.user_role_of_a_group')</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->full_name }}</td>
                            <td>{{ $user->role->name }}</td>
                            @endforeach
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <div class="col">

        <div class="card">
            <div class="card-header">@lang('group.add_user_of_a_group')</div>
            <div class="card-body">
                formulaire ici
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalDeleteGroup" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">@lang('group.modal_title_delete_group',
                    ['name' =>
                    $group->name])</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>@lang('group.modal_warning_no_possible_rollback', ['name' => $group->name])</p>
            </div>
            <div class="modal-footer">
                <form class="form-inline" method="POST" action="/schools/{{$school->id}}/groups/{{ $group->id }}">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">
                        <i class="bi bi-chevron-left"></i> @lang('group.cancel_delete')</button>
                    <button type="submit" class="btn btn-sm btn-danger ml-3"><i
                            class="bi bi-trash"></i>@lang('group.confirm_delete', ['name' =>
                        $group->name])</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection