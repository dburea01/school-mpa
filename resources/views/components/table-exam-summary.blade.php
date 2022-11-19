<table class="table table-sm table-bordered" aria-label="exam summary">
    <tr>
        <th>@lang('exam-summary.exam-title')</th>
        <td>{{ $exam->title }}</td>
    </tr>
    <tr>
        <th>@lang('exam-summary.exam-date')</th>
        <td>{{ $exam->start_date }}</td>
    </tr>
    <tr>
        <th>@lang('exam-summary.exam-type')</th>
        <td>{{ $examType->name }}</td>
    </tr>
    <tr>
        <th>@lang('exam-summary.exam-status')</th>
        <td>{{ $examStatus->short_name }}</td>
    </tr>
    <tr>
        <th>@lang('exam-summary.exam-classroom')</th>
        <td>{{ $classroom->name }}</td>
    </tr>
</table>
<table class="table table-sm table-bordered" aria-label="exam reports">
    <tr>
        <th>@lang('exam-summary.exam-avg')</th>
        <td>{{ $reportExam['avg'] }}</td>
    </tr>
    <tr>
        <th>@lang('exam-summary.exam-min')</th>
        <td>{{ $reportExam['min'] }}</td>
    </tr>
    <tr>
        <th>@lang('exam-summary.exam-max')</th>
        <td>{{ $reportExam['max'] }}</td>
    </tr>

    <tr>
        <th>@lang('exam-summary.qty-notes')</th>
        <td>{{ $reportExam['qtyNotes'] }}</td>
    </tr>
</table>
