<select class="form-select form-select-sm" name="{{ $name }}" id="{{ $id }}" required onchange="{{ $onchange }}">
    <option value="">@lang('select-period.select_a_period')</option>
    @foreach ($periods as $period)
    <option value="{{ $period->id }}" @if ($period->id === $value) selected @endif>
        {{ $period->name }}
        @if ($period->current) (x) @endif
    </option>
    @endforeach
</select>
