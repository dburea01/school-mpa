<select class="form-select form-select-sm" name="{{$name}}" id="{{$id}}" @if($required==='true' ) required @endif>
    <option value="">&nbsp;{{ $placeholder }}</option>
    @foreach ($subjects as $subject)
    <option value="{{ $subject->id }}" @if ($subject->id == $value) selected @endif>{{ $subject->short_name }}</option>
    @endforeach
</select>
