@extends('user.layouts.app')
@section('content-breadcrumbs')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Пошук</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
{{--                {{ Breadcrumbs::render('dashboard') }}--}}
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <!-- general form elements disabled -->
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Пошук об'єкта</h3>
                    </div>
                    <!-- /.card-header -->
                    <div  id="app">

                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div><!-- /.container-fluid -->
@endsection
@section('scripts')
    <script src="{{ asset('js/search.js') }}"></script>
@endsection
