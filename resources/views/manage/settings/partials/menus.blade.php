<option value>-- не задано --</option>
@foreach ($menus as $menu)
    <option value="{{ $menu->id }}"
            @if($menu->id == $selectedItems)
            selected
            @endif
    >{{ $menu->defaultContent()->title or "(Имя не задано)" }}</option>
@endforeach