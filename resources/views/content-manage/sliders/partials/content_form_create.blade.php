    {{-- Form include --}}
    @include('content-manage.sliders.partials.content_fields')

    <input type="hidden" name="contentLang[{{ $lang->locale }}][created_by]" value="{{Auth::id()}}">
