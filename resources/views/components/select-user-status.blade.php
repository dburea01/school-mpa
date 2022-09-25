<select class="form-select form-select-sm" name="{{$name}}" id="{{$id}}" @if($required) required @endif>
    <option value="">@lang('select-status.all_status')</option>
    <option value="ACTIVE" @if ($status==="ACTIVE" ) selected @endif>Active</option>
    <option value="INACTIVE" @if ($status==="INACTIVE" ) selected @endif>Inactive</option>
</select>
