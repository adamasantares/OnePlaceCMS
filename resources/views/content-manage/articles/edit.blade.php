@extends('admin.layouts.main')

@section('content')
<div class="card parent-container create_article" data-content-id="{{ $article->id }}">
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
            <form id="content" action="{{route('app.article.update', $article)}}" method="post">
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
            <input class="btn btn-success" name="save" type="submit" value="Сохранить" form="content">
            <input class="btn btn-success" type="submit" value="Сохранить и закрыть" form="content">
            <a class="btn btn-default" href="{{ route("admin.article.index") }}">Закрыть</a>
        </div>
    </div>
    <!-- /.card-footer-->
</div>

    @if(!empty($langs))
        @foreach($langs as $lang)
            @if(!empty($contentLang = $article->contents()->where('lang_id', $lang->id)->first()))
                <form id="content-delete-{{$lang->id}}" style="display: none;" onsubmit="if(confirm('Удалить?')){ return true }else{ return false }" action="{{route('app.article-content.destroy', $contentLang)}}" method="post">
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="hidden" name="id" value="{{$contentLang->id}}">
                    {{ csrf_field() }}
                </form>
            @endif
        @endforeach
    @endif
@endsection