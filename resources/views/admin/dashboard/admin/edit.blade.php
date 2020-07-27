@extends('admin.layouts.app')
@section('styles')
    <link rel="stylesheet" href="{{asset('adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.css')}}">
@endsection

@section('content-header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Изменить данные администратора</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">

                {{ Breadcrumbs::render('admin-edit', $admin->name) }}

            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-md-8 ">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Основная информация:</h3>
                    </div>
                    <form action="{{route('admin.update', $admin->id)}}" method="POST" class="admin-form"
                          enctype="multipart/form-data">
                        @csrf
                        {{method_field('PUT')}}
                        <div class="card-body">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                </div>
                                <input type="text" name="name" value="{{$admin->name}}"
                                       class="form-control @error('name') is-invalid @enderror"
                                       placeholder="Имя администратора"
                                       required autofocus>
                                @error('name')
                                <span class="admin-form_error-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @enderror

                            </div>
                            <div class="form-group">

                                <input type="password" name="password"
                                       class="form-control @error('password') is-invalid @enderror"
                                       value=""
                                       id="exampleInputPassword1"
                                       placeholder="Пароль">
                                @error('password')
                                <span class="admin-form_error-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @enderror

                            </div>
                            <div class="input-group mb-3">

                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                </div>
                                <input type="email" name="email"
                                       class="form-control @error('email') is-invalid @enderror"
                                       value="{{$admin->email}}" placeholder="Email">
                                @error('email')
                                <span class="admin-form_error-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="input-group mb-3">

                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                </div>
                                <input type="tel" name="phone" class="form-control @error('phone') is-invalid @enderror"
                                       id=""
                                       value="{{$admin->phone}}" placeholder="Телефон">
                                @error('phone')
                                <span class="admin-form_error-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @enderror

                            </div>

                            <div class="form-group">
                                <label>Доступные роли:</label>
                                @foreach($roles->chunk(7) as $chunk)
                                    <ul class="p-0">
                                        @foreach($chunk as $role)
                                            <div class="custom-control custom-checkbox">
                                                <input
                                                    class="custom-control-input " type="checkbox"
                                                    id="{{$role->id}}" name="roles[]" value="{{$role->name}}"
                                                    @if($adminRoles->contains($role->name)) checked @endif
                                                >
                                                <label
                                                    for="{{$role->id}}"
                                                    class="custom-control-label">{{$role->name}}
                                                </label>
                                            </div>
                                        @endforeach
                                    </ul>
                                @endforeach
                            </div>
{{--                            <div class="custom-control custom-switch">--}}
{{--                                <input type="checkbox" name="activate"--}}
{{--                                       class="custom-control-input"--}}
{{--                                       {{$admin->activate === 'on' ? 'checked=checked' : ''}}--}}
{{--                                       id="customSwitch1">--}}
{{--                                <label class="custom-control-label" for="customSwitch1">Активация аккаунта</label>--}}
{{--                            </div>--}}
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Изменить</button>
                        </div>
                    </form>

                </div>
            </div>
            <div class="col-12">
                <form action="{{route('admin.delete', $admin->id)}}" method="POST">
                    @csrf
                    {{method_field('DELETE')}}
                    <button class="btn btn-danger">Удалить учетную запись <i class="fas fa-trash"></i></button>
                </form>
            </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
@endsection
@section('scripts')
    <script src="{{ asset('adminlte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
    <script src="https://unpkg.com/imask"></script>

    <script>
        $(document).ready(function () {
            let phoneInput = IMask(
                document.getElementById('phoneAdmin'),
                {
                    mask: '+{38}(000)000-00-00',
                    lazy: false,
                    placeholderChar: '_'
                }
            );
            $('#adminsList').DataTable({
                "language": {
                    "url": "http://cdn.datatables.net/plug-ins/1.10.19/i18n/Russian.json"
                },
            });
        });
    </script>
@endsection
