@extends('manage.layouts.main')

@section('content')
<div class="row">
  <div class="col-12">
     <div class="card">
        <div class="card-header">
           <h3 class="card-title">{{ __('content-models.title-list') }}</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
           <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
              <div class="row">
                 <div class="col-sm-12 col-md-6">
                    <div class="card-tools">
                      <div class="input-group input-group-sm">
                        <form style="padding: 0" role="search" action="{{ route('manage.content-model.index') }}">
                            <div class="input-group add-on">
                                <input class="form-control float-right" placeholder="Search" name="query-content-model" type="text" value="{{ request()->get('query-content-model') }}">
                                <div class="input-group-append">
                                    <button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                      </div>
                    </div>                         
                 </div>
                 <div class="col-sm-12 col-md-6">
                    <a href="{{route('manage.content-model.create')}}" class="btn btn-success pull-right" style="margin: 0 0 7px">Create content model</a>
                 </div> 
              </div>
              <div class="row">
                 <div class="col-sm-12">
                    <table class="table table-bordered table-striped dataTable" role="grid" >
                       <thead>
                          <tr role="row">
                             <th>Title</th>
                             <th style="width: 150px">Date create</th>
                             <th style="width: 84px">Action</th>
                          </tr>
                       </thead>
                       <tbody>
                            @forelse ($models as $key => $model)
                                <tr>
                                    <td>
                                        {{ $model->title }}
                                    </td>
                                    <td>
                                        {{ $model->published == 1 ? 'Published' : 'Not published' }}
                                    </td>
                                    <td>{{ $model->created_at }}</td>
                                    <td style="width: 84px">
                                        <form onsubmit="if(confirm('Удалить?')){ return true }else{ return false }" action="{{route('manage.content-model.destroy', $model)}}" method="post">
                                          <input type="hidden" name="_method" value="DELETE">
                                          {{ csrf_field() }}
                                          <a class="btn btn btn-primary" href="{{route('manage.content-model.edit', $model)}}">
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
                                 <td colspan="4" class="text-center"><h2>No data available</h2></td>
                              </tr>                                    
                            @endforelse
                       </tbody>
                       <tfoot>
                          <tr>
                              <th>Title</th>
                              <th>Date create</th>
                              <th style="width: 84px">Action</th>
                          </tr>
                       </tfoot>
                    </table>
                 </div>
              </div>
              <div class="row">
                 <div class="col-sm-12 col-md-12">
                    {{ $models->links('manage.partials.pagination') }}
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
