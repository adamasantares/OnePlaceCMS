@foreach ($sliders as $slider)
  <option value="{{ $slider->id }}"
          @isset($article->slider()->id)
            @if($slider->id == $article->slider()->id)
                selected
            @endif
          @endisset
  >{{ $slider->defaultContent()->title or "(Name not set)" }}</option>
@endforeach
