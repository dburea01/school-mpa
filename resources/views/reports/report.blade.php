@extends('layouts.app_layout')

@section('content')

<h1 class="text-center">@lang('report.title')</h1>

<div class="row mt-3">
    <div class="col-md-4">

        <table class="table table-sm table-striped table-bordered table-hover" aria-label="users report">
            <thead>
                <tr>
                    <th colspan="2" class="text-center">@lang('report.user_summary')</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($summary_users_by_role as $role)
                <tr>
                    <th>{{ App\Models\Role::find($role->role_id)->name }}</th>
                    <td>{{ $role->user_count }}</td>
                </tr>
                @endforeach
                <tr class="table-info">
                    <th>@lang('report.user_total')</th>
                    <td><strong>{{ $summary_users_by_role->sum('user_count') }}</strong></td>
                </tr>
            </tbody>
        </table>

    </div>

    <div class="col-md-4">

        <table class="table table-sm table-striped table-bordered table-hover" aria-label="sex-report">
            <thead>
                <tr>
                    <th colspan="2" class="text-center">@lang('report.sex_summary')</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($summary_students_by_gender as $gender)
                <tr>
                    <th>
                        @switch($gender->gender_id)
                        @case(1)
                        @lang('report.gender_male')
                        @break
                        @case(2)
                        @lang('report.gender_female')
                        @break
                        @default
                        @lang('report_gender_not_defined')
                        @endswitch
                    </th>
                    <td>{{ $gender->user_count }}</td>
                </tr>
                @endforeach
                <tr class="table-info">
                    <th>&nbsp;</th>
                    <td><strong>{{ $summary_students_by_gender->sum('user_count') }}</strong></td>
                </tr>

            </tbody>
        </table>

    </div>

</div>



@endsection