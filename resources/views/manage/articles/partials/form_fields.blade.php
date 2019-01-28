<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <label for="slug">Slug</label>
            <input class="form-control {{ $errors->has('slug') ? 'is-invalid' : '' }}"
                   id="slug" type="text" name="slug" placeholder="Алиас" autocomplete="off" required
                   value="{{ old("slug", $article->slug) }}">

            @if($errors->has('slug'))
                <div class="invalid-feedback">
                    {{ $errors->first('slug') }}
                </div>
            @endif       
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="">Category</label>
            <select class="form-control" name="parent_id">
                <option value="">-- empty --</option>
                @include('manage.articles.partials.categories', ['categories' => $categories])
            </select>
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label for="date-public">Date public</label>
            <input id="date-public" class="form-control {{ $errors->has('date_public') ? 'is-invalid' : '' }}"
                   type="text" name="date_public" placeholder="Date public" autocomplete="off"
                   data-position='left bottom'
                   data-dateFormat='yyyy-dd-mm'
                   value="{{ old("date_public", $article->date_public ? date("d.m.Y", $article->date_public) : '') }}">

            @if($errors->has('date_public'))
                <div class="invalid-feedback">
                    {{ $errors->first('date_public') }}
                </div>
            @endif
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label style="display: block;">Status</label>
            <div class="btn-group btn-group-toggle published-toggle" data-toggle="buttons">
                <label class="btn {{ $article->published ? 'btn-success active' : 'btn-default'  }}">
                    <input type="radio" name="published" value="1" {{ $article->published ? 'checked' : '' }}><i class="fa fa-check" aria-hidden="true"></i> Published
                </label>
                <label class="btn {{ $article->published ? 'btn-default' : 'btn-danger active' }}">
                    <input type="radio" name="published" value="0" {{ $article->published ? '' : 'checked' }}><i class="fa fa-times" aria-hidden="true"></i> Not published
                </label>
            </div>
        </div>
    </div>
</div>

<div class="form-group">
    <label for="title">Title</label>
    <input id="title" type="text" class="form-control content-title-input {{ $errors->has('title') ? 'is-invalid' : '' }}"
           name="title" placeholder="Title" autocomplete="off"
           value="{{ old("title", $article->title) }}">

    @if($errors->has('title'))
        <div class="invalid-feedback">
            {{ $errors->first('title') }}
        </div>
    @endif
</div>

<div class="form-group">
    <label for="annotation">Annotation</label>
    <textarea id="annotation" class="form-control {{ $errors->has('annotation') ? 'is-invalid' : '' }}"
              type="text" name="annotation" placeholder="Annotation" autocomplete="off">
        {{ old("annotation", $article->annotation) }}
    </textarea>
    @if($errors->has('annotation'))
        <div class="invalid-feedback">
            {{ $errors->first('annotation') }}
        </div>
    @endif
</div>

<div class="form-group">
    <label for="full_text">Content</label>
    <textarea id="full_editor" class="article-full_text-editor summernote form-control {{ $errors->has('content') ? 'is-invalid' : '' }}"
              type="text" name="content" placeholder="Content" autocomplete="off">
        {{ old("content", $article->content) }}
    </textarea>
    @if($errors->has('content'))
        <div class="invalid-feedback">
            {{ $errors->first('content') }}
        </div>
    @endif
</div>

<div class="form-group">
    <label for="description">Meta description</label>
    <input id="description" class="summernote form-control {{ $errors->has('meta_description') ? 'is-invalid' : '' }}"
           type="text" name="meta_description" placeholder="Meta description" autocomplete="off"
           value="{{ old("meta_description", $article->meta_description) }}">

    @if($errors->has('meta_description'))
        <div class="invalid-feedback">
            {{ $errors->first('meta_description') }}
        </div>
    @endif
</div>

<div class="form-group">
    <label for="keywords">Meta keywords</label>
    <input id="keywords" class="form-control {{ $errors->has('meta_keywords') ? 'is-invalid' : '' }}" type="text"
           name="meta_keywords" placeholder="Meta keywords" autocomplete="off"
           value="{{ old("meta_keywords", $article->meta_keywords) }}">

    @if($errors->has('meta_keywords'))
        <div class="invalid-feedback">
            {{ $errors->first('meta_keywords') }}
        </div>
    @endif
</div>

<div class="row">
    <div class="col-md-8">
        <div class="form-group">
            <label for="add-tags">Tags</label>
            <select id="add-tags" name="tags[]" multiple="multiple" data-placeholder="Tags">
               @foreach($tags as $tag)
                   <option value="{{ $tag->id }}" selected="selected">{{ $tag->title }}</option> 
               @endforeach
            </select>
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label for="">Slider</label>
            <select class="form-control" name="slider_id">
                <option value>-- empty --</option>
                @include('manage.articles.partials.sliders', ['sliders' => $sliders])
            </select>
        </div>
    </div>

</div>
<input name="type" type="hidden" value="1">
<input type="hidden" name="modified_by" value="{{Auth::id()}}">



