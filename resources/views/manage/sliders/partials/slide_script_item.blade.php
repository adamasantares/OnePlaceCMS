<script id="template-slide" type="text/x-custom-template">
    <div class="accordion-item card card-info">
        <div class="card-header">
            <h4 class="card-title pull-left">
                <a data-toggle="collapse" data-parent="#accordion" data-href="accordionItemHref" data-content="title">

                </a>
            </h4>
            <div class="btn-group pull-right">
                <a class="btn btn-default btn-xs btnUpSlider btnMoveSlider color-gray" href="#">
                    <i class="fa fa-chevron-up" aria-hidden="true"></i>
                </a>
                <a class="btn btn-default btn-xs btnDownSlider btnMoveSlider color-gray" href="#">
                    <i class="fa fa-chevron-down"></i>
                </a>
                <a class="btn btn-primary btn-xs btnEditSlider" data-href="accordionItemHref" data-toggle="collapse" data-parent="#accordion" class="collapsed" aria-expanded="false">
                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                </a>
                <a class="btn btn-danger btn-xs btnRemoveSlider" href="#">
                    <i class="fa fa-times clickable"></i>
                </a>
            </div>
        </div>
        <div data-id="accordionItemId" class="panel-collapse collapse in">
            <div class="card-body">
                <form id="slideForm">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="content_id" class="control-label">Существующий контент</label>
                                <div class="input-group input-group-select-2 input-group-select-2--right">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><input type="radio" name="type" value="1"></span>
                                    </div>
                                    <select id="content_id" name="content_id" data-placeholder="Контент">
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="url" class="control-label">Произвольный URL</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><input type="radio" name="type" value="2"></span>
                                    </div>
                                    <input id="url" type="text" name="url" class="form-control item-menu">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group pull-right">
                                <label style="display: block;">Статус</label>
                                <div class="btn-group btn-group-toggle published-toggle" data-toggle="buttons">
                                    <label class="btn btn-default">
                                        <input type="radio" name="published" value="1"><i class="fa fa-check" aria-hidden="true"></i> Опубликовано
                                    </label>
                                    <label class="btn btn-danger active">
                                        <input type="radio" name="published" value="0" checked><i class="fa fa-times" aria-hidden="true"></i> Не опубликовано
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group select2-image">
                                <label for="image_id" class="control-label">Изображение</label>
                                <select id="image_id" name="image_id" data-placeholder="Изображение">
                                    <option></option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group select2-image">
                                <label for="icon_id" class="control-label">Иконка</label>
                                <select id="icon_id" name="icon_id" data-placeholder="Иконка">
                                    <option></option>
                                </select>
                            </div>
                        </div>
                    </div>
                    @if(!empty($langs))
                        <nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                @foreach($langs as $lang)
                                    <a class="nav-item nav-link @if($lang->default == 1)  active show @endif" id="{{$lang->slug}}-tab" data-toggle="tab" href="#{{$lang->slug}}" role="tab" aria-controls="{{$lang->slug}}" aria-selected="true">{{$lang->name}}</a>
                                @endforeach
                            </div>
                        </nav>
                        <div class="tab-content tab-lang-content">
                            @foreach($langs as $lang)
                                <div id="{{$lang->slug}}" class="tab-pane @if($lang->default == 1) active show @endif">
                                    <h3>{{$lang->name}}</h3>
                                    @php
                                        $contentLang = new App\SliderLang;
                                    @endphp
                                    @include('manage.sliders.partials.content_form_create')
                                </div>
                            @endforeach
                        </div>
                    @endif

                </form>
            </div>
        </div>
    </div>
</script>