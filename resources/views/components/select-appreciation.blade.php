<select class="form-select form-select-sm" name="{{$name}}" @if($required==='true' ) required @endif>
    <option value="">&nbsp;{{ $placeholder }}</option>
    @foreach ($appreciations as $appreciation)

    <option value="{{ $appreciation->id }}" @if (isset($studentResult->appreciation->id) and
        $studentResult->appreciation->id == $appreciation->id) selected
        @endif>{{$appreciation->name}}
    </option>
    @endforeach
</select>
