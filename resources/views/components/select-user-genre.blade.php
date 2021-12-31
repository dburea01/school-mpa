<select class="form-select form-select-sm" name="{{$name}}" id="{{$id}}" @if($required) required @endif>
    <option value="">&nbsp;</option>
    <option value="1" @if ($value==="1" ) selected @endif>@lang('select-genre.male')</option>
    <option value="2" @if ($value==="2" ) selected @endif>@lang('select-genre.female')</option>
</select>