@extends('admin.layouts.main')

@section('content')
<div class="row">
  <div class="col-12">
     <div class="card">
        <div class="card-header">
           <h3 class="card-title">Articles list</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
           <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
              <div class="row">
                 <div class="col-sm-12 col-md-6">
                    <div class="card-tools">
                      <div class="input-group input-group-sm">
                        <form style="padding: 0" role="search" action="{{ route('app.article.index') }}">
                            <div class="input-group add-on">
                                <input class="form-control float-right" placeholder="Search" name="query-article" type="text" value="{{$query}}">
                                <div class="input-group-append">
                                    <button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                      </div>
                    </div>                         
                 </div>
                 <div class="col-sm-12 col-md-6">
                    <a href="{{route('app.article.create')}}" class="btn btn-success pull-right" style="margin: 0 0 7px">Create page</a>
                 </div> 
              </div>
              <div class="row">
                 <div class="col-sm-12">
                    <table class="table table-bordered table-striped dataTable" role="grid" >
                       <thead>
                          <tr role="row">
                             <th>Title</th>
                             <th>Slug</th>
                             <th>Status</th>
                             <th>Date create</th>
                             <th style="width: 84px">Action</th>
                          </tr>
                       </thead>
                       <tbody>
                            @forelse ($articles as $key => $article)
                                <tr>
                                    <td>
                                        @empty($article->title)
                                            <i>(Not set)</i>
                                        @else
                                            {{ $article->title }}
                                        @endempty
                                    </td>
                                    <td>
                                        @empty($article->slug)
                                          <i>(Not set)</i>
                                        @else
                                          {{ $article->slug }}
                                        @endempty
                                    </td>
                                    <td>
                                        @if($article->published == 1)
                                            Published
                                        @else
                                            Not published
                                        @endif
                                    </td>
                                    <td>{{$article->created_at}}</td>
                                    <td style="width: 84px">
                                        <form onsubmit="if(confirm('Удалить?')){ return true }else{ return false }" action="{{route('app.article.destroy', $article)}}" method="post">
                                          <input type="hidden" name="_method" value="DELETE">
                                          {{ csrf_field() }}
                                          <a class="btn btn btn-primary" href="{{route('app.article.edit', $article)}}">
                                              <i class="fa fa-edit"></i>
                                          </a>
                                          <button type="submit" class="btn btn btn-danger">
                                              <i class="fa fa-trash" aria-hidden="true"></i>
                                          </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                              <tr role="row" class="odd">
                                 <td colspan="5" class="text-center"><h2>No data available</h2></td>
                              </tr>                                    
                            @endforelse
                       </tbody>
                       <tfoot>
                          <tr>
                              <th>Title</th>
                              <th>Slug</th>
                              <th>Status</th>
                              <th>Date create</th>
                              <th style="width: 84px">Action</th>
                          </tr>
                       </tfoot>
                    </table>
                 </div>
              </div>
              <div class="row">
                 <div class="col-sm-12 col-md-12">
                    {{$articles->links('admin.partials.pagination')}}
                 </div>
              </div>
           </div>
        </div>
        <!-- /.card-body -->
     </div>
     <!-- /.card -->
  </div>
  <!-- /.col -->
</div>
<!-- /.row -->
@endsection
