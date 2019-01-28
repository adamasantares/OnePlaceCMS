<div class="accordion-item card card-info">
    <div class="card-header">
        <h4 class="card-title pull-left">
            <a data-toggle="collapse" data-parent="#accordion" data-href="accordionItemHref" data-content="title">
                {{ (isset($sliderItem->defaultContent()->title) && !empty($sliderItem->defaultContent()->title)) ? $sliderItem->defaultContent()->title : "Слайд {$counter}" }}
            </a>
        </h4>
        <div class="btn-group pull-right">
            <a class="btn btn-default btn-xs btnUpSlider btnMoveSlider color-gray" href="#">
                <i class="fa fa-chevron-up" aria-hidden="true"></i>
            </a>
            <a class="btn btn-default btn-xs btnDownSlider btnMoveSlider color-gray" href="#">
                <i class="fa fa-chevron-down"></i>
            </a>
            <a class="btn btn-primary btn-xs btnEditSlider" href="#collapse{{$counter}}" data-toggle="collapse" data-parent="#accordion" class="collapsed" aria-expanded="false">
                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
            </a>
            <a class="btn btn-danger btn-xs btnRemoveSlider" href="#">
                <i class="fa fa-times clickable"></i>
            </a>
        </div>
    </div>
    <div id="collapse{{$counter}}" class="panel-collapse collapse in">
        <div class="card-body">
            <form id="slideForm">
                <input type="hidden" name="id" value="{{ $sliderItem->id }}">
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="content_id" class="control-label">Существующий контент</label>
                            <div class="input-group input-group-select-2 input-group-select-2--right">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><input type="radio" name="type" value="1" @if($sliderItem->type == 1) checked @endif></span>
                                </div>
                                <select id="content_id" name="content_id" data-placeholder="Контент">
                                    @php
                                        $type = '';
                                        $option = $sliderItem->content()->first();

                                        if(!empty($option)) {
                                            switch ($option->type) {
                                                case 1:
                                                    $type = '[Страница] ';
                                                    break;
                                                case 2:
                                                    $type = '[Категория] ';
                                                    break;
                                            }
                                        }
                                    @endphp
                                    @if(!empty($option))
                                        <option value="{{ $option->id }}">{{ $type.$option->defaultContent()->title }}</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="url" class="control-label">Произвольный URL</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><input type="radio" name="type"value="2" @if($sliderItem->type == 2) checked @endif></span>
                                </div>
                                <input id="url" type="text" name="url" placeholder="URL"  class="form-control item-menu" value="{{ $sliderItem->url }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group pull-right">
                            <label style="display: block;">Статус</label>
                            <div class="btn-group btn-group-toggle published-toggle" data-toggle="buttons">
                                <label class="btn @if($sliderItem->published == 1) btn-success active @else btn-default @endif">
                                    <input type="radio" name="published" value="1" @if($sliderItem->published == 1) checked @endif><i class="fa fa-check" aria-hidden="true"></i> Опубликовано
                                </label>
                                <label class="btn @if($sliderItem->published == 0) btn-danger active @else btn-default @endif">
                                    <input type="radio" name="published" value="0" @if($sliderItem->published == 0) checked @endif><i class="fa fa-times" aria-hidden="true"></i> Не опубликовано
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group select2-image">
                            @php
                                $defaultData = [];
                                $image = $sliderItem->image();
                                if(!empty($image)) {
                                    $defaultData['id'] = $image->id;
                                    $defaultData['text'] = basename($image->file_url);
                                    $defaultData['thumb'] = $image->thumb()->file_url;
                                }
                            @endphp
                            <label for="image_id" class="control-label">Изображение</label>
                            <select id="image_id" name="image_id" data-placeholder="Изображение">
                                @if($defaultData)
                                    <option value="{{ $defaultData['id'] }}" selected>@json($defaultData)</option>
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group select2-image">
                            @php
                                $defaultData = [];
                                $icon = $sliderItem->icon();
                                if(!empty($icon)) {
                                    $defaultData['id'] = $icon->id;
                                    $defaultData['text'] = basename($icon->file_url);
                                    $defaultData['thumb'] = $icon->thumb()->file_url;
                                }
                            @endphp
                            <label for="icon_id" class="control-label">Иконка</label>
                            <select id="icon_id" name="icon_id" data-placeholder="Иконка">
                                @if($defaultData)
                                    <option value="{{ $defaultData['id'] }}" selected>@json($defaultData)</option>
                                @endif
                            </select>
                        </div>
                    </div>
                </div>

                @if(!empty($langs))
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            @foreach($langs as $lang)
                                <a class="nav-item nav-link @if($lang->default == 1)  active show @endif" id="{{$lang->slug}}-tab-{{$counter}}" data-toggle="tab" href="#{{$lang->slug}}-{{$counter}}" role="tab" aria-controls="{{$lang->slug}}" aria-selected="true">{{$lang->name}}</a>
                            @endforeach
                        </div>
                    </nav>
                    <div class="tab-content tab-lang-content">
                        @foreach($langs as $lang)
                            <div id="{{$lang->slug}}-{{$counter}}" class="tab-pane @if($lang->default == 1) active show @endif">
                                <h3>{{$lang->name}}</h3>
                                @if(!empty($contentLang = $sliderItem->sliderContents()->where('lang_id', $lang->id)->first()))
                                    @include('manage.sliders.partials.content_form_edit', ['contentLang' => $contentLang])
                                @else
                                    @include('manage.sliders.partials.content_form_create')
                                @endif
                            </div>
                        @endforeach
                    </div>
                @endif

            </form>
        </div>
    </div>
</div>