<select class="form-select form-select-sm" name="{{$name}}" id="{{$id}}" @if($required) required @endif>
    <option value="">&nbsp;</option>
    <option value="1" @if ($value==="1" ) selected @endif>@lang('select-gender.male')</option>
    <option value="2" @if ($value==="2" ) selected @endif>@lang('select-gender.female')</option>
</select>
