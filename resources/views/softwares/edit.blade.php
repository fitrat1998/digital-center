@extends('adminsuper.layouts.admin')

@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{__('messages.softwares.title')}}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('index') }}">{{__('messages.home')}}</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('softwares.index') }}">{{__('messages.softwares.name')}}</a></li>
                        <li class="breadcrumb-item active">{{__('messages.crud.edit')}}</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-lg-8 offset-lg-2 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{__('messages.crud.edit')}}</h3>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('softwares.update', $software->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label>{{__('messages.softwares.title')}} - <img src="{{ asset('uz.png') }}" alt="uz" width="18"></label>
                                <input type="text" name="title_uz" class="form-control {{ $errors->has('title_uz') ? 'is-invalid' : '' }}" value="{{ old('title_uz', $software->title_uz) }}" required>
                                @if($errors->has('title_uz'))
                                    <span class="error invalid-feedback">{{ $errors->first('title_uz') }}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label>{{__('messages.softwares.title')}} - <img src="{{ asset('ru.png') }}" alt="ru" width="18"></label>
                                <input type="text" name="title_ru" class="form-control {{ $errors->has('title_ru') ? 'is-invalid' : '' }}" value="{{ old('title_ru', $software->title_ru) }}" required>
                                @if($errors->has('title_ru'))
                                    <span class="error invalid-feedback">{{ $errors->first('title_ru') }}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label>{{__('messages.softwares.title')}} - <img src="{{ asset('en.png') }}" alt="en" width="18"></label>
                                <input type="text" name="title_en" class="form-control {{ $errors->has('title_en') ? 'is-invalid' : '' }}" value="{{ old('title_en', $software->title_en) }}" required>
                                @if($errors->has('title_en'))
                                    <span class="error invalid-feedback">{{ $errors->first('title_en') }}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label>{{ __('messages.softwares.description') }} - <img src="{{ asset('uz.png') }}" alt="uz" width="18"></label>
                                <textarea name="description_uz" class="form-control editor {{ $errors->has('description_uz') ? 'is-invalid' : '' }}">{{ old('description_uz', $software->description_uz) }}</textarea>
                                @if($errors->has('description_uz'))
                                    <span class="error invalid-feedback">{{ $errors->first('description_uz') }}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label>{{ __('messages.softwares.description') }} - <img src="{{ asset('ru.png') }}" alt="ru" width="18"></label>
                                <textarea name="description_ru" class="form-control editor {{ $errors->has('description_ru') ? 'is-invalid' : '' }}">{{ old('description_ru', $software->description_ru) }}</textarea>
                                @if($errors->has('description_ru'))
                                    <span class="error invalid-feedback">{{ $errors->first('description_ru') }}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label>{{ __('messages.softwares.description') }} - <img src="{{ asset('en.png') }}" alt="en" width="18"></label>
                                <textarea name="description_en" class="form-control editor {{ $errors->has('description_en') ? 'is-invalid' : '' }}">{{ old('description_en', $software->description_en) }}</textarea>
                                @if($errors->has('description_en'))
                                    <span class="error invalid-feedback">{{ $errors->first('description_en') }}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label>{{__('messages.softwares.photo')}}</label>
                                <input type="file" name="photo" class="form-control {{ $errors->has('photo') ? 'is-invalid' : '' }}">
                                @if($errors->has('photo'))
                                    <span class="error invalid-feedback">{{ $errors->first('photo') }}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label>{{ __('messages.departments.title') }}</label>
                                <select name="category_id" class="form-control select2 {{ $errors->has('category_id') ? 'is-invalid' : '' }}" required>
                                    <option value="">--</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id', $software->category_id) == $category->id ? 'selected' : '' }}>
                                            {{ $category['name_' . app()->getLocale()] }}
                                        </option>
                                    @endforeach
                                </select>
                                @if($errors->has('category_id'))
                                    <span class="error invalid-feedback">{{ $errors->first('category_id') }}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-success float-right">{{__('messages.save')}}</button>
                                <a href="{{ route('softwares.index') }}" class="btn btn-danger float-left">{{__('messages.cancel')}}</a>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
