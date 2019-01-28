@extends('layouts.administration')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Заявка</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                        <div class="row">
                            <div class="col-sm-12">
                                <table class="table table-striped">
                                    <tbody>
                                        <tr>
                                            <th width="30%">Имя</th>
                                            <td width="70%">{{ $message->name }}</td>
                                        </tr>
                                        <tr>
                                            <th width="30%">Телефон</th>
                                            <td width="70%">{{ $message->phone }}</td>
                                        </tr>
                                        <tr>
                                            <th width="30%">Email</th>
                                            <td width="70%">{{ $message->email }}</td>
                                        </tr>
                                        <tr>
                                            <th width="30%">Коммент</th>
                                            <td width="70%">{{ $message->comment }}</td>
                                        </tr>

                                        <tr>
                                            <th width="30%">Дата создания</th>
                                            <td width="70%">{{ $message->created_at }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <div class="btn-group pull-right" role="group" aria-label="...">
                        <a class="btn btn-default" href="{{ route("admin.message.index") }}">Закрыть</a>
                    </div>
                </div>
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
@endsection