<select class="form-select" name="{{$name}}" id="{{$id}}" @if($required) required @endif>
    <option value="">&nbsp;</option>
    <option value="ACTIVE" @if ($status==="ACTIVE" ) selected @endif>Active</option>
    <option value="INACTIVE" @if ($status==="INACTIVE" ) selected @endif>Inactive</option>
</select>