@extends('layouts.administration')

@section('content')
    <div class="card parent-container">
        <div class="card-header d-flex p-0">
            <h3 class="card-title p-3">Изменение тега</h3>
        </div>
        <form role="form" action="{{route('app.tag.update', $tag)}}" method="post">
            <div class="card-body">
                <input type="hidden" name="_method" value="put">
                {{ csrf_field() }}
                <input type="hidden" name="modified_by" value="{{Auth::id()}}">
                <div class="form-group">
                    <label for="title">Тег</label>
                    <input type="text" class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}"
                           name="title" id="title" value="{{$tag->title or ""}}" required>
                    @if($errors->has('title'))
                        <div class="invalid-feedback">
                            {{ $errors->first('title') }}
                        </div>
                    @endif                 
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <div class="btn-group pull-left" role="group" aria-label="...">
                    <input class="btn btn-success" name="save" type="submit" value="Сохранить и закрыть">
                    <a class="btn btn-default" href="{{ route("admin.tag.index") }}">Закрыть</a>
                </div>
            </div>
        </form>
    </div>
@endsection