@foreach ($categories as $category)
    <option value="{{ $category->id }}"
            @if(in_array($category->id, $selectedItems))
            selected
            @endif
    >{{ $category->defaultContent()->title or "(Имя не задано)" }}</option>
@endforeach