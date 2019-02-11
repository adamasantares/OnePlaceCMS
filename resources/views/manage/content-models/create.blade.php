@extends('manage.layouts.main')

@section('content')
<div class="card parent-container create_article">
    <div class="card-header d-flex p-0">
        <h3 class="card-title p-3">Create content model</h3>
    </div>
    <div class="card-body">
        <form id="content" action="{{ route('manage.content-model.create') }}" method="post">
            <input type="hidden" name="_method" value="put">
            {{ csrf_field() }}

            {{-- Form fields include --}}
            @include('manage.content-models.partials.form_fields')
        </form>
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
        <div class="btn-group pull-right" role="group" aria-label="...">
            <input class="btn btn-success" name="save" type="submit" value="Save" form="content">
            <a class="btn btn-default" href="{{ route("manage.content-model.index") }}">Close</a>
        </div>
    </div>
    <!-- /.card-footer-->
</div>

@endsection