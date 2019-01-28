@extends('layouts.administration')

@section('content')
    <div class="card parent-container">
        <div class="card-header d-flex p-0">
            <h3 class="card-title p-3">Редактирование профиля</h3>
        </div>
        <form role="form" action="{{route('manage', $user)}}" method="post" autocomplete="off">
            <div class="card-body">
                <input type="hidden" name="_method" value="put">
                {{ csrf_field() }}

                {{-- Form include --}}
                @include('manage.users.partials.form')
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <div class="btn-group pull-left" role="group" aria-label="...">
                    <input class="btn btn-success" name="save" type="submit" value="Сохранить и закрыть">
                    <a class="btn btn-default" href="{{ route("admin.user.index") }}">Закрыть</a>
                </div>
            </div>
        </form>
    </div>
@endsection

