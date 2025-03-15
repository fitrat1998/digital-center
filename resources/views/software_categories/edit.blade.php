@extends('adminsuper.layouts.admin')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{__('messages.software_categories.name')}}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('softwarecategories.index') }}">{{__('messages.home')}}</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('softwarecategories.index') }}">{{__('messages.software_categories.name')}}</a></li>
                        <li class="breadcrumb-item active">{{__('messages.crud.edit')}}</li>
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
                        <h3 class="card-title">{{__('messages.crud.edit')}}</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                        <form action="{{ route('softwarecategories.update', $category->id) }}" method="post">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label>{{__('messages.news.title')}} - <img src="{{ asset('uz.png') }}" alt="uz" width="18"></label>
                                <input type="text" name="name_uz"
                                       class="form-control {{ $errors->has('name_uz') ? 'is-invalid':'' }}"
                                       value="{{ old('name_uz', $category->name_uz) }}" required>
                                @error('name_uz')
                                <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>{{__('messages.news.title')}} - <img src="{{ asset('en.png') }}" alt="en" width="18"></label>
                                <input type="text" name="name_en"
                                       class="form-control {{ $errors->has('name_en') ? 'is-invalid':'' }}"
                                       value="{{ old('name_en', $category->name_en) }}" required>
                                @error('name_en')
                                <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>{{__('messages.news.title')}} - <img src="{{ asset('ru.png') }}" alt="ru" width="18"></label>
                                <input type="text" name="name_ru"
                                       class="form-control {{ $errors->has('name_ru') ? 'is-invalid':'' }}"
                                       value="{{ old('name_ru', $category->name_ru) }}" required>
                                @error('name_ru')
                                <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <button type="submit"
                                        class="btn btn-success float-right">{{__('messages.save')}}</button>
                                <a href="{{ route('softwarecategories.index') }}"
                                   class="btn btn-danger float-left">{{__('messages.cancel')}}</a>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
