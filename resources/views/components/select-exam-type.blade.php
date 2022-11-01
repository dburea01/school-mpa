<select class="form-select form-select-sm" name="{{$name}}" id="{{$id}}" @if($required==='true' ) required @endif>
    <option value="">{{ $placeholder }}</option>
    @foreach ($examTypes as $examType)
    <option value="{{ $examType->id }}" @if ($examType->id == $value) selected @endif>{{ $examType->name }}</option>
    @endforeach
</select>
