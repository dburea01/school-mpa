<select class="form-select form-select-sm" name="{{$name}}" id="{{$id}}" @if($required==='true' ) required @endif>

    <option value="">{{ $placeholder }}</option>
    @foreach ($examStatus as $examStatu)
    <option value="{{ $examStatu->id }}" @if ($examStatu->id == $value) selected @endif>{{ $examStatu->short_name }}
    </option>
    @endforeach
</select>
