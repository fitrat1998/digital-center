@extends('adminsuper.layouts.admin')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{__('messages.softwares.name')}}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('index') }}">{{__('messages.home')}}</a></li>
                        <li class="breadcrumb-item"><a
                                href="{{ route('softwares.index') }}">{{__('messages.softwares.name')}}</a></li>
                        <li class="breadcrumb-item active">{{__('messages.crud.add')}}</li>
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
                        <h3 class="card-title">{{__('messages.crud.add')}}</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                        <form action="{{ route('softwares.store') }}" method="post" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label>{{__('messages.softwares.title')}} - <img src="{{ asset('uz.png') }}" alt="uz"
                                                                                 width="18"></label>
                                <input type="text" name="title_uz"
                                       class="form-control {{ $errors->has('title_uz') ? "is-invalid":"" }}"
                                       value="{{ old('title_uz') }}" required>
                                @if($errors->has('title_uz'))
                                    <span class="error invalid-feedback">{{ $errors->first('title_uz') }}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label>{{__('messages.softwares.title')}} - <img src="{{ asset('ru.png') }}" alt="uz"
                                                                                 width="18"></label>
                                <input type="text" name="title_en"
                                       class="form-control {{ $errors->has('title_ru') ? "is-invalid":"" }}"
                                       value="{{ old('title_ru') }}" required>
                                @if($errors->has('title_ru'))
                                    <span class="error invalid-feedback">{{ $errors->first('title_ru') }}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label>{{__('messages.softwares.title')}} - <img src="{{ asset('en.png') }}" alt="uz"
                                                                                 width="18"></label>
                                <input type="text" name="title_ru"
                                       class="form-control {{ $errors->has('title_ru') ? "is-invalid":"" }}"
                                       value="{{ old('title_ru') }}" required>
                                @if($errors->has('title_ru'))
                                    <span class="error invalid-feedback">{{ $errors->first('title_ru') }}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="description_uz">{{ __('messages.softwares.description') }} - <img
                                        src="{{ asset('uz.png') }}" alt="uz"
                                        width="18"></label>
                                <textarea name="description_uz" id="description_uz"
                                          class="form-control editor">{{ old('description_uz') }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="description_en">{{ __('messages.softwares.description') }} - <img
                                        src="{{ asset('en.png') }}" alt="uz"
                                        width="18"></label>
                                <textarea name="description_en" id="description_en"
                                          class="form-control editor">{{ old('description_en') }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="description_ru">{{ __('messages.softwares.description') }} - <img
                                        src="{{ asset('ru.png') }}" alt="uz"
                                        width="18"></label>
                                <textarea name="description_ru" id="description_ru"
                                          class="form-control editor">{{ old('description_ru') }}</textarea>
                            </div>


                            <div class="form-group">
                                <label>{{__('messages.softwares.photo')}}</label>

                                <input type="file" name="photo"
                                       class="form-control {{ $errors->has('photo') ? "is-invalid":"" }}"
                                       value="{{ old('photo') }}" required>
                                @if($errors->has('photo'))
                                    <span class="error invalid-feedback">{{ $errors->first('photo') }}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label>{{ __('messages.departments.title') }}</label>
                                <select name="category_id"
                                        class="form-control select2 {{ $errors->has('category_id') ? 'is-invalid' : '' }}"
                                        required>
                                    <option value="">--</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category['name_' . app()->getLocale()] }}
                                        </option>
                                    @endforeach
                                </select>

                                @if($errors->has('category_id'))
                                    <span class="error invalid-feedback">{{ $errors->first('category_id') }}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <button type="submit"
                                        class="btn btn-success float-right">{{__('messages.save')}}</button>
                                <a href="{{ route('softwares.index') }}"
                                   class="btn btn-danger float-left">{{__('messages.cancel')}}</a>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
