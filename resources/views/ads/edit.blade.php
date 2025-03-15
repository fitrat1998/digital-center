@extends('adminsuper.layouts.admin')

@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{__('messages.ads.title')}}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('index') }}">{{__('messages.home')}}</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('ads.index') }}">{{__('messages.ads.title')}}</a></li>
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
                        <form action="{{ route('ads.update', $ads->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            @foreach(['uz', 'en', 'ru'] as $locale)
                                <div class="form-group">
                                    <label>{{__('messages.ads.title')}} - <img src="{{ asset($locale.'.png') }}" alt="{{$locale}}" width="18"></label>
                                    <input type="text" name="title_{{$locale}}" class="form-control {{ $errors->has('title_'.$locale) ? 'is-invalid' : '' }}" value="{{ old('title_'.$locale, $ads->{'title_'.$locale}) }}" required>
                                    @if($errors->has('title_'.$locale))
                                        <span class="error invalid-feedback">{{ $errors->first('title_'.$locale) }}</span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label>{{ __('messages.ads.description') }} - <img src="{{ asset($locale.'.png') }}" alt="{{$locale}}" width="18"></label>
                                    <textarea name="description_{{$locale}}" id="description_{{$locale}}" class="form-control editor">{{ old('description_'.$locale, $ads->{'description_'.$locale}) }}</textarea>
                                </div>
                            @endforeach

                            <div class="form-group">
                                <label>{{__('messages.ads.photo')}}</label>
                                <input type="file" name="photo" class="form-control {{ $errors->has('photo') ? 'is-invalid' : '' }}">
                                @if($errors->has('photo'))
                                    <span class="error invalid-feedback">{{ $errors->first('photo') }}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-success float-right">{{__('messages.save')}}</button>
                                <a href="{{ route('ads.index') }}" class="btn btn-danger float-left">{{__('messages.cancel')}}</a>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
