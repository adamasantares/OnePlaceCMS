@foreach ($roles as $role)
    <option value="{{ $role }}"
    @if(!empty($user))
        @if($user->hasRole($role))
            selected
        @endif
    @endif
    >{{ $role }}</option>
@endforeach