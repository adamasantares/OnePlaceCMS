@extends('layouts.administration')

@section('content')
<div class="row">
  <div class="col-12">
     <div class="card">
        <div class="card-header">
           <h3 class="card-title">Список тегов</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
           <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
              <div class="row">
                  <div class="col-sm-12 col-md-6" style="margin-bottom: 10px;">
                    <div class="card-tools">
                      <div class="input-group input-group-sm">
                        <form style="padding: 0" role="search" action="{{ route('app.tag.index') }}">
                            <div class="input-group add-on">
                                <input class="form-control float-right" placeholder="Поиск" name="query-tag" type="text" value="{{$query}}">
                                <div class="input-group-append">
                                    <button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                      </div>
                    </div>                         
                 </div>
              </div>
              <div class="row">
                 <div class="col-md-8">
                    <table class="table table-bordered table-striped dataTable" role="grid" >
                       <thead>
                          <tr role="row">
                             <th>Тег</th>
                             <th style="width: 84px">Действие</th>
                          </tr>
                       </thead>
                       <tbody>
                            @forelse ($tags as $key => $tag)
                                <tr>
                                    <td>
                                        {{$tag->title}}
                                    </td>
                                    <td style="width: 84px">
                                        <form onsubmit="if(confirm('Удалить?')){ return true }else{ return false }" action="{{route('app.tag.destroy', $tag)}}" method="post">
                                          <input type="hidden" name="_method" value="DELETE">
                                          {{ csrf_field() }}
                                          <a class="btn btn btn-primary" href="{{route('app.tag.edit', $tag)}}">
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
                                 <td colspan="2" class="text-center"><h2>Данные отсутствуют</h2></td>
                              </tr>                                    
                            @endforelse
                       </tbody>
                       <tfoot>
                          <tr>
                             <th>Тег</th>
                             <th style="width: 84px">Действие</th>
                          </tr>
                       </tfoot>
                    </table>
                 </div>
                 <div class="col-md-4">
                    <div class="card card-primary">
                      <div class="card-header">
                        <h3 class="card-title">Создать тег</h3>
                      </div>
                      <!-- /.card-header -->
                      <!-- form start -->
                      <form role="form" action="{{route('content-manage')}}" method="post">
                        <div class="card-body">
                          <div class="form-group">
                            <label for="title">Тег</label>
                            <input type="text" name="title" class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}"
                                   id="title" placeholder="Наименование" autocomplete="off">
                            @if($errors->has('title'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('title') }}
                                </div>
                            @endif                           
                          </div>
                          {{ csrf_field() }}
                          <input type="hidden" name="created_by" value="{{Auth::id()}}">                            
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                          <button type="submit" class="btn btn-primary">Создать</button>
                        </div>
                      </form>
                    </div>                     
                 </div> 
              </div>
              <div class="row">
                 <div class="col-sm-12 col-md-12">
                    {{$tags->links('vendor.pagination.administration')}}
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