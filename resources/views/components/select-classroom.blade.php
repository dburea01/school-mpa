<select class="form-select form-select-sm" name="{{$name}}" id="{{$id}}" @if($required==='true' ) required @endif>
    <option value="">{{ $placeholder }}</option>
    @foreach ($classrooms as $classroom)
    <option value="{{ $classroom->id }}" @if ($classroom->id === $value) selected @endif>{{ $classroom->name }}</option>
    @endforeach
</select>
