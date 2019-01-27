@extends('admin.layouts.main')

@section('content')
<div class="card parent-container create_article">
    <div class="card-header d-flex p-0">
        <h3 class="card-title p-3">Edit article</h3>
        <ul class="nav nav-pills ml-auto p-2">
          <li class="nav-item"><a class="nav-link active show" href="#article" data-toggle="tab">Article</a></li>
          <li class="nav-item"><a class="nav-link" href="#media" data-toggle="tab">Images</a></li>
        </ul>
    </div>
    <div class="card-body">
        <div class="tab-content">
          <div class="tab-pane active show" id="article">
            <form id="content" action="{{ route('content-manage') }}" method="post">
                <input type="hidden" name="_method" value="put">
                {{ csrf_field() }}

                {{-- Form fields include --}}
                @include('content-manage.articles.partials.form_fields')
            </form>
          </div>
          <!-- /.tab-pane -->
          <div class="tab-pane" id="media">
            @include('content-manage.articles.partials.media')
          </div>
          <!-- /.tab-pane -->
        </div>
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
        <div class="btn-group pull-right" role="group" aria-label="...">
            <input class="btn btn-success" name="save" type="submit" value="Save" form="content">
            <a class="btn btn-default" href="{{ route("admin.article.index") }}">Close</a>
        </div>
    </div>
    <!-- /.card-footer-->
</div>

@endsection