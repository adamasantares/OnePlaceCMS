@extends('layouts.administration')

@section('content')

<div class="row">
  <div class="col-12">
     <div class="card">
        <div class="card-header">
           <h3 class="card-title">Редактирование меню</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            @include('manage.menu.partials.form')
            <hr>
            <div class="row">
                <div class="col-md-8">
                    @include('manage.menu.partials.menu_list')
                </div>
                <div class="col-md-4">
                    @include('manage.menu.partials.form_edit_item_menu')
                </div>
            </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <div class="btn-group pull-right" role="group" aria-label="...">
                <input class="btn btn-success" name="save" type="submit" value="Сохранить" form="build-menu">
                <input class="btn btn-success" type="submit" value="Сохранить и закрыть" form="build-menu">
                <a class="btn btn-default" href="{{ route("admin.menu.index") }}">Закрыть</a>
            </div>
        </div>
     </div>
</div>

@endsection