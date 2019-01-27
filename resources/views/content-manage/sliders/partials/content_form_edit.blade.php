<input type="hidden" name="_method" value="put">
<input type="hidden" name="contentLang[{{ $lang->locale }}][id]" value="{{$contentLang->id}}">
{{-- Form include --}}
@include('content-manage.sliders.partials.content_fields')
<input type="hidden" name="contentLang[{{ $lang->locale }}][modified_by]" value="{{Auth::id()}}">
{{--<div class="btn-group" role="group" aria-label="...">--}}
    {{--<button type="submit" class="btn btn-danger" form="content-delete-{{$lang->id}}"><i class="glyphicon glyphicon-trash"></i> Удалить</button>--}}
{{--</div>--}}

