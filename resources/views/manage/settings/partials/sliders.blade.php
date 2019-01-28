<option value>-- не задано --</option>
@foreach ($sliders as $slider)
    <option value="{{ $slider->id }}"
            @if($slider->id == $selectedItems)
            selected
            @endif
    >{{ $slider->defaultContent()->title or "(Имя не задано)" }}</option>
@endforeach