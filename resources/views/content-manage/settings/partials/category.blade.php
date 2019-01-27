<option value>-- не задано --</option>
@foreach ($categories as $category)
    <option value="{{ $category->id }}"
            @if($category->id == $selectedItem)
            selected
            @endif
    >{{ $category->defaultContent()->title or "(Имя не задано)" }}</option>
@endforeach