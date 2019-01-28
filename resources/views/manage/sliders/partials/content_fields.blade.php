<div class="form-group">
    <label for="title">Заголовок</label>
    <input id="title" type="text" class="form-control
           {{ $errors->has('contentLang.'.$lang->locale.'.title') ? 'is-invalid' : '' }}"
           name="contentLang[{{ $lang->locale }}][title]" placeholder="Заголовок" autocomplete="off"
           value="{{ old("contentLang.{$lang->locale}.title", $contentLang['title']) }}">
    @if($errors->has('contentLang.'.$lang->locale.'.title'))
        <div class="invalid-feedback">
            {{ $errors->first('contentLang.'.$lang->locale.'.title') }}
        </div>
    @endif
</div>

<div class="form-group">
    <label for="button_text">Текст в кнопке</label>
    <input id="button_text" name="contentLang[{{ $lang->locale }}][button_text]" type="text" class="form-control" placeholder="Текст в кнопке" value="{{ old("contentLang.{$lang->locale}.button_text", $contentLang['button_text']) }}">
    @if($errors->has('contentLang.'.$lang->locale.'.button_text'))
        <div class="invalid-feedback">
            {{ $errors->first('contentLang.'.$lang->locale.'.button_text') }}
        </div>
    @endif  
</div>

<div class="form-group">
    <label for="slide_text">Текст в слайде</label>
    <textarea id="slide_text" class="slider-intro_text-editor summernote form-control @if($errors->has('contentLang.'.$lang->locale.'.slide_text')) is-invalid @endif" type="text" name="contentLang[{{ $lang->locale }}][slide_text]" placeholder="Содержание" autocomplete="off">{{ old("contentLang.{$lang->locale}.slide_text", $contentLang['slide_text']) }}</textarea>
    @if($errors->has('contentLang.'.$lang->locale.'.slide_text'))
        <div class="invalid-feedback">
            {{ $errors->first('contentLang.'.$lang->locale.'.slide_text') }}
        </div>
    @endif  
</div>



<input type="hidden" name="contentLang[{{$lang->locale}}][slider_id]" value="{{$slider->id}}">
<input type="hidden" name="contentLang[{{ $lang->locale }}][lang_id]" value="{{$lang->id}}">
