<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">Список пунктов меню</h3>
    </div>
    <div class="card-body">
        <div class="form-group" style="width: 350px;">
            <label for="category_id" class="control-label">Добавить список из элементов категории</label>
            <div class="input-group input-group-select-2 input-group-select-2--left">
                <select id="category_id" name="category_id" data-placeholder="Категория">
                </select>
                <span class="input-group-append">
                    <button type="button" id="btnCreatList" class="btn btn-success"><i class="fa fa-plus"></i></button>
                </span>
            </div>
        </div>
        <ul id="menuEditor" class="sortableLists list-group" data-default-lang="{{$langs->where('default', 1)->first()->slug}}" data-menu-list='@json($menuList)'>
        </ul>
    </div>
</div>