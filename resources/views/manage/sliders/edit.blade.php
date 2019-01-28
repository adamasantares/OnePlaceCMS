@extends('layouts.administration')

@section('content')
<div id="sliderEdit" class="card parent-container" data-content-id="{{ $slider->id }}">
    <div class="card-header d-flex p-0">
        <h3 class="card-title p-3">Редактирование слайдера</h3>
        <ul class="nav nav-pills ml-auto p-2">
            <li class="nav-item"><a class="nav-link active show" href="#slider" data-toggle="tab">Слайдер</a></li>
            <li class="nav-item"><a class="nav-link" href="#media" data-toggle="tab">Медиа</a></li>
        </ul>
    </div>
    <div class="card-body">
        <div class="tab-content">
            <div class="tab-pane active show" id="slider">
                @include('manage.sliders.partials.form')
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <h3 class="pull-left">Список слайдов</h3>
                        <a id="addSlide" class="btn btn-primary btn-md pull-right" href="#">Добавить слайд</a>
                    </div>
                </div>
                <hr>
                <div id="accordion">
                    @forelse($sliderItems as $index => $sliderItem)
                        @php
                            $counter = $index + 1;
                        @endphp
                        @include('manage.sliders.partials.slide_item')
                    @empty
                    @endforelse
                </div>

                @include('manage.sliders.partials.slide_script_item')
            </div>
            <!-- /.tab-pane -->
            <div class="tab-pane" id="media">
                @include('manage.sliders.partials.media')
            </div>
            <!-- /.tab-pane -->
        </div>
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
        <div class="btn-group pull-right" role="group" aria-label="...">
            <input class="btn btn-success" name="save" type="submit" value="Сохранить" form="build-slider">
            <input class="btn btn-success" type="submit" value="Сохранить и закрыть" form="build-slider">
            <a class="btn btn-default" href="{{ route("admin.slider.index") }}">Закрыть</a>
        </div>
    </div>
    <!-- /.card-footer-->
</div>

@endsection