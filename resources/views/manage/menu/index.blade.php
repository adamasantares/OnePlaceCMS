@extends('layouts.administration')

@section('content')
<div class="row">
  <div class="col-12">
     <div class="card">
        <div class="card-header">
           <h3 class="card-title">Список меню</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
           <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
              <div class="row">
                 <div class="col-sm-12 col-md-6">
                    <div class="card-tools">
                      <div class="input-group input-group-sm">
                        <form style="padding: 0" role="search" action="{{ route('app.menu.index') }}">
                            <div class="input-group add-on">
                                <input class="form-control float-right" placeholder="Поиск" name="query-menu" type="text" value="{{$query}}">
                                <div class="input-group-append">
                                    <button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                      </div>
                    </div>                         
                 </div>
                 <div class="col-sm-12 col-md-6">
                    <a href="{{route('app.menu.create')}}" class="btn btn-success pull-right" style="margin: 0 0 7px">Создать меню</a>
                 </div> 
              </div>
              <div class="row">
                 <div class="col-sm-12">
                    <table class="table table-bordered table-striped dataTable" role="grid" >
                       <thead>
                          <tr role="row">
                             <th>Заголовок</th>
                             <th>Статус</th>
                             <th>Дата создания</th>
                             <th style="width: 84px">Действие</th>
                          </tr>
                       </thead>
                       <tbody>
                            @forelse ($menus as $key => $menu)
                                <tr>
                                    <td>
                                        @php
                                            $contentOnDefaultLang = $menu->defaultContent();
                                        @endphp
                                        @isset($contentOnDefaultLang->title)
                                            {{ $contentOnDefaultLang->title }}
                                        @else
                                            <i>(Не задано)</i>
                                        @endisset
                                    </td>
                                    <td>
                                        @if($menu->published == 1)
                                          Опубликовано
                                        @else
                                          Не опубликовано
                                        @endif
                                    </td>
                                    <td>{{$menu->created_at}}</td>
                                    <td style="width: 84px">
                                        <form onsubmit="if(confirm('Удалить?')){ return true }else{ return false }" action="{{route('manage', $menu)}}" method="post">
                                          <input type="hidden" name="_method" value="DELETE">
                                          {{ csrf_field() }}
                                          <a class="btn btn btn-primary" href="{{route('app.menu.edit', $menu)}}">
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
                                 <td colspan="5" class="text-center"><h2>Данные отсутствуют</h2></td>
                              </tr>                                    
                            @endforelse
                       </tbody>
                       <tfoot>
                          <tr>
                             <th>Заголовок</th>
                             <th>Статус</th>
                             <th>Дата создания</th>
                             <th style="width: 84px">Действие</th>
                          </tr>
                       </tfoot>
                    </table>
                 </div>
              </div>
              <div class="row">
                 <div class="col-sm-12 col-md-12">
                    {{ $menus->links('vendor.pagination.administration') }}
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
