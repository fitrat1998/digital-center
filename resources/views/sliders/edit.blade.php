@extends('adminsuper.layouts.admin')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{__('messages.sliders.name')}}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('index') }}">{{__('messages.home')}}</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('sliders.index') }}">{{__('messages.sliders.name')}}</a></li>
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

                        <form action="{{ route('sliders.update', $slider->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label>{{__('messages.sliders.title')}} - <img src="{{ asset('uz.png') }}" alt="uz" width="18"></label>
                                <input type="text" name="title_uz"
                                       class="form-control {{ $errors->has('title_uz') ? 'is-invalid' : '' }}"
                                       value="{{ old('title_uz', $slider->title_uz) }}" required>
                                @error('title_uz')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>{{__('messages.sliders.title')}} - <img src="{{ asset('ru.png') }}" alt="ru" width="18"></label>
                                <input type="text" name="title_ru"
                                       class="form-control {{ $errors->has('title_ru') ? 'is-invalid' : '' }}"
                                       value="{{ old('title_ru', $slider->title_ru) }}" required>
                                @error('title_ru')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>{{__('messages.sliders.title')}} - <img src="{{ asset('en.png') }}" alt="en" width="18"></label>
                                <input type="text" name="title_en"
                                       class="form-control {{ $errors->has('title_en') ? 'is-invalid' : '' }}"
                                       value="{{ old('title_en', $slider->title_en) }}" required>
                                @error('title_en')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="caption_uz">{{ __('messages.sliders.caption') }}  - <img src="{{ asset('uz.png') }}" alt="uz" width="18"></label>
                                <textarea name="caption_uz" id="caption_uz"
                                          class="form-control editor {{ $errors->has('caption_uz') ? 'is-invalid' : '' }}">{{ old('caption_uz', $slider->caption_uz) }}</textarea>
                                @error('caption_uz')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="caption_en">{{ __('messages.sliders.caption') }}  - <img src="{{ asset('en.png') }}" alt="en" width="18"></label>
                                <textarea name="caption_en" id="caption_en"
                                          class="form-control editor {{ $errors->has('caption_en') ? 'is-invalid' : '' }}">{{ old('caption_en', $slider->caption_en) }}</textarea>
                                @error('caption_en')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="caption_ru">{{ __('messages.sliders.caption') }}  - <img src="{{ asset('ru.png') }}" alt="ru" width="18"></label>
                                <textarea name="caption_ru" id="caption_ru"
                                          class="form-control editor {{ $errors->has('caption_ru') ? 'is-invalid' : '' }}">{{ old('caption_ru', $slider->caption_ru) }}</textarea>
                                @error('caption_ru')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>{{__('messages.sliders.photo')}}</label>
                                <input type="file" name="photo"
                                       class="form-control {{ $errors->has('photo') ? 'is-invalid' : '' }}">
                                @error('photo')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror

                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-success float-right">{{__('messages.save')}}</button>
                                <a href="{{ route('sliders.index') }}" class="btn btn-danger float-left">{{__('messages.cancel')}}</a>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
