@foreach ($categories as $category)

  <option value="{{$category->id or ""}}"

    @isset($article->parent_id)

      @if ($article->parent_id == $category->id)
        selected=""
      @endif

    @endisset

    >
    {!! $delimiter or "" !!}{{$category->title or "(Not set)"}}
  </option>

  @if (count($category->childrenCategories) > 0)

    @include('manage.articles.partials.categories', [
      'categories' => $category->childrenCategories,
      'delimiter'  => ' - '
    ])

  @endif
@endforeach
