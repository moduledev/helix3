@extends('admin.layouts.app')


@section('content-breadcrumbs')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Роль {{$role->name}}</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                {{ Breadcrumbs::render('role', $role->name) }}

            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-md-12 ">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Перелік ролей:</h3>
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item"> <i class="fas fa-plus-square"></i> <span>Название роли:</span> {{$role->name}} </li>
                            <li class="list-group-item"><i class="fas fa-arrows-alt"></i> <span>Разрешения роли:</span>
                                <ul class="">
                                    @foreach($permissions as $permission)
                                        <li class="">{{$permission->name}}</li>
                                    @endforeach
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
@endsection

