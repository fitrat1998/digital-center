@extends('adminsuper.layouts.admin')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{__('messages.departments.title')}}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('index') }}">{{__('messages.home')}}</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('departments.index') }}">{{__('messages.departments.title')}}</a></li>
                        <li class="breadcrumb-item active">{{__('messages.departments.user_create')}}</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->

    <section class="content">
        <div class="row">
            <div class="col-lg-8 offset-lg-2 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{__('messages.departments.department_create')}}</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                        <form action="{{ route('departments.store') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label>{{__('messages.departments.title')}} - <img src="{{ asset('uz.png') }}" alt="uz" width="18"></label>
                                <input type="text" name="name_uz"
                                       class="form-control {{ $errors->has('name_uz') ? "is-invalid":"" }}"
                                       value="{{ old('name_uz') }}" required>
                                @if($errors->has('name_uz'))
                                    <span class="error invalid-feedback">{{ $errors->first('name_uz') }}</span>
                                @endif
                            </div>

                             <div class="form-group">
                                <label>{{__('messages.departments.title')}} - <img src="{{ asset('ru.png') }}" alt="uz" width="18"></label>
                                <input type="text" name="name_en"
                                       class="form-control {{ $errors->has('name_ru') ? "is-invalid":"" }}"
                                       value="{{ old('name_ru') }}" required>
                                @if($errors->has('name_ru'))
                                    <span class="error invalid-feedback">{{ $errors->first('name_ru') }}</span>
                                @endif
                            </div>

                             <div class="form-group">
                                <label>{{__('messages.departments.title')}} - <img src="{{ asset('en.png') }}" alt="uz" width="18"></label>
                                <input type="text" name="name_ru"
                                       class="form-control {{ $errors->has('name_ru') ? "is-invalid":"" }}"
                                       value="{{ old('name_ru') }}" required>
                                @if($errors->has('name_ru'))
                                    <span class="error invalid-feedback">{{ $errors->first('name_ru') }}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-success float-right">{{__('messages.save')}}</button>
                                <a href="{{ route('departments.index') }}" class="btn btn-danger float-left">{{__('messages.cancel')}}</a>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
