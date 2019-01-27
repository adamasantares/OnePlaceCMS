<div id="editItemBlock" class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Пункт меню</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form id="frmEdit">
        <div class="card-body">
            <input name="id" type="hidden" value="" class="item-menu">

            @foreach($langs as $lang)
                <div class="form-group">
                    <label for="text" class="control-label">[{{ $lang->locale }}] Заголовок</label>
                    <div class="input-group">
                        <input type="text" class="form-control item-menu" name="content[{{ $lang->slug }}][title]" id="title-{{$lang->slug}}" placeholder="[{{ $lang->locale }}] Заголовок"
                               @if($lang->default == 1) required @endif>

                        @if($lang->default == 1)
                            <div class='invalid-feedback'>Это обязательное поле.</div>
                        @endif
                    </div>
                </div>
                <input type="hidden" name="content[{{ $lang->slug }}][lang_id]" value="{{ $lang->id }}">
                <input type="hidden" name="content[{{ $lang->slug }}][id]" value="">
            @endforeach

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

            <div class="form-group">
                <label for="url" class="control-label">Произвольный URL</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><input type="radio" name="type" value="2"></span>
                    </div>
                    <input id="url" type="text" name="url" class="form-control item-menu">
                </div>
            </div>

            <div class="form-group">
                <label for="class">CSS класс пункта меню</label>
                <input type="text" class="form-control item-menu" id="class" name="class" placeholder="CSS класс пункта меню">
            </div>

            <div class="form-group">
                <label for="icon">CSS иконки пункта меню</label>
                <input type="text" class="form-control item-menu" id="class" name="icon" placeholder="CSS класс иконки пункта меню">
            </div>

            <div class="form-group">
                <label for="target" class="control-label">Target</label>
                <select name="target" id="target" class="form-control item-menu">
                    <option value="_self">Self</option>
                    <option value="_blank">Blank</option>
                    <option value="_top">Top</option>
                </select>
            </div>

            <div class="form-check">
                <label class="form-check-label">
                    <input class="form-check-input" name="published" type="checkbox" value="1">
                    Опубликовано
                </label>
            </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <button type="button" id="btnUpdate" class="btn btn-primary" disabled><i class="fa fa-refresh"></i> Обновить</button>
            <button type="button" id="btnAdd" class="btn btn-success"><i class="fa fa-plus"></i> Добавить</button>
            <button type="button" id="btnReset" class="btn btn-warning">Очистить форму</button>
        </div>
    </form>
</div>