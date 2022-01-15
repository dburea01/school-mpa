<select class="form-select form-select-sm" name="{{ $name }}" id="{{ $id }}" @change="onChangeRole($event)">
    <option value="">@lang('select-role.select_all_roles')</option>
    @foreach ($roles as $role)
    <option value="{{ $role->id }}" @if ($role->id === $value) selected @endif>{{ $role->name }}</option>
    @endforeach
</select>