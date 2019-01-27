@extends('layouts.administration')

@section('content')
    <div class="card parent-container">
        <div class="card-header d-flex p-0">
            <h3 class="card-title p-3">Настройки</h3>
        </div>
        <form role="form" action="{{route('app.setting.update')}}" method="post">
            <div class="card-body">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="slider-on-main">Слайдер на главной</label>
                    <select id="slider-on-main" class="form-control" name="settings[slider-on-main]">
                        @include('content-manage.settings.partials.sliders', ['sliders' => $sliders, 'selectedItems' => $settings['slider-on-main'] ?? []])
                    </select>
                </div>
                <div class="form-group">
                    <label for="links-on-main">Ссылки на главной</label>
                    <select id="links-on-main" class="form-control" name="settings[links-on-main]">
                        @include('content-manage.settings.partials.sliders', ['sliders' => $sliders, 'selectedItems' => $settings['links-on-main'] ?? []])
                    </select>
                </div>
                <div class="form-group">
                    <label for="banner-on-main">Баннер на главной</label>
                    <select id="banner-on-main" class="form-control" name="settings[banner-on-main]">
                        @include('content-manage.settings.partials.sliders', ['sliders' => $sliders, 'selectedItems' => $settings['banner-on-main'] ?? []])
                    </select>
                </div>

                <div class="form-group">
                    <label for="categories-on-main">Категории для "Новое на сайте"</label>
                    <select id="categories-on-main" class="form-control" name="settings[categories-on-main][]" multiple>
                        @include('content-manage.settings.partials.categories', ['categories' => $categories, 'selectedItems' => $settings['categories-on-main'] ?? []])
                    </select>
                </div>

                <div class="form-group">
                    <label for="reviews-on-main">Отзывы на главной</label>
                    <select id="reviews-on-main" class="form-control" name="settings[reviews-on-main]">
                        @include('content-manage.settings.partials.sliders', ['sliders' => $sliders, 'selectedItems' => $settings['reviews-on-main'] ?? []])
                    </select>
                </div>
                <div class="form-group">
                    <label for="reviews-on-main">Главное меню</label>
                    <select id="reviews-on-main" class="form-control" name="settings[main-menu]">
                        @include('content-manage.settings.partials.menus', ['menus' => $menus, 'selectedItems' => $settings['main-menu'] ?? []])
                    </select>
                </div>
                <div class="form-group">
                    <label for="reviews-on-main">Боковое меню(нормативные документы)</label>
                    <select id="reviews-on-main" class="form-control" name="settings[sidebar-dokumenty]">
                        @include('content-manage.settings.partials.menus', ['menus' => $menus, 'selectedItems' => $settings['sidebar-dokumenty'] ?? []])
                    </select>
                </div>
                <div class="form-group">
                    <label for="reviews-on-main">Боковое меню(Мед. оборудование)</label>
                    <select id="reviews-on-main" class="form-control" name="settings[sidebar-meditsinskoe-oborudovanie]">
                        @include('content-manage.settings.partials.menus', ['menus' => $menus, 'selectedItems' => $settings['sidebar-meditsinskoe-oborudovanie'] ?? []])
                    </select>
                </div>
                <div class="form-group">
                    <label for="categories-on-main">Категория для "Отчеты"</label>
                    <select id="categories-on-main" class="form-control" name="settings[sidebar-reports]">
                        @include('content-manage.settings.partials.category', ['categories' => $categories, 'selectedItem' => $settings['sidebar-reports'] ?? []])
                    </select>
                </div>
                <div class="form-group">
                    <label for="reviews-on-main">Боковое меню(Наши услуги)</label>
                    <select id="reviews-on-main" class="form-control" name="settings[sidebar-uslugu]">
                        @include('content-manage.settings.partials.menus', ['menus' => $menus, 'selectedItems' => $settings['sidebar-uslugu'] ?? []])
                    </select>
                </div>
                <div class="form-group">
                    <label for="reviews-on-main">Боковое меню(Росздрав)</label>
                    <select id="reviews-on-main" class="form-control" name="settings[sidebar-uslugu-roszdrav]">
                        @include('content-manage.settings.partials.menus', ['menus' => $menus, 'selectedItems' => $settings['sidebar-uslugu-roszdrav'] ?? []])
                    </select>
                </div>
            </div>
            <div class="card-footer">
                <div class="btn-group pull-left" role="group" aria-label="...">
                    <input class="btn btn-success" type="submit" value="Сохранить">
                </div>
            </div>
        </form>
    </div>
@endsection

