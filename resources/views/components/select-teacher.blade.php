<select class="form-select form-select-sm" name="{{$name}}" id="{{$id}}" @if($required==='true' ) required @endif>
    <option value="">&nbsp;{{ $placeholder }}</option>
    @foreach ($teachers as $teacher)
    <option value="{{ $teacher->id }}" @if ($teacher->id == $value) selected @endif>
        {{ $teacher->last_name }} {{ $teacher->first_name }}
    </option>
    @endforeach
</select>
