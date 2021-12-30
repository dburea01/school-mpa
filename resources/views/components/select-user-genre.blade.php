<select class="form-select" name="{{$name}}" id="{{$id}}" @if($required) required @endif>
    <option value="">&nbsp;</option>
    <option value="1" @if ($genre_id==="1" ) selected @endif>@lang('select-genre.male')</option>
    <option value="2" @if ($genre_id==="2" ) selected @endif>@lang('select-genre.female')</option>
</select>