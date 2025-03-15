@extends('adminsuper.layouts.admin')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{__('messages.staffs.edit')}}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('index') }}">{{__('messages.home')}}</a></li>
                        <li class="breadcrumb-item"><a
                                href="{{ route('staffs.index') }}">{{__('messages.staffs.title')}}</a></li>
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

                        <form action="{{ route('staffs.update', $staff->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label>{{__('messages.staffs.fullname')}} </label>
                                <input type="text" name="fullname"
                                       class="form-control {{ $errors->has('fullname') ? 'is-invalid':'' }}"
                                       value="{{ old('fullname', $staff->fullname) }}" required>
                                @if($errors->has('fullname'))
                                    <span class="error invalid-feedback">{{ $errors->first('fullname') }}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label>{{__('messages.staffs.photo')}} </label>
                                <input type="file" name="photo"
                                       class="form-control {{ $errors->has('photo') ? 'is-invalid':'' }}">
                                @if($staff->photo)
                                    <div class="mt-2">
                                        <img src="{{ asset('storage/' . $staff->photo) }}" alt="{{ $staff->fullname }}" width="100">
                                    </div>
                                @endif
                                @if($errors->has('photo'))
                                    <span class="error invalid-feedback">{{ $errors->first('photo') }}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label>{{ __('messages.departments.title') }}</label>
                                <select name="position_id"
                                        class="form-control select2 {{ $errors->has('position_id') ? 'is-invalid' : '' }}"
                                        required>
                                    <option value="">--</option>
                                    @foreach($positions as $position)
                                        <option value="{{ $position->id }}"
                                            {{ old('position_id', $staff->position_id) == $position->id ? 'selected' : '' }}>
                                            {{ $position['name_' . app()->getLocale()] }}
                                        </option>
                                    @endforeach
                                </select>

                                @if($errors->has('position_id'))
                                    <span class="error invalid-feedback">{{ $errors->first('position_id') }}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-success float-right">{{__('messages.save')}}</button>
                                <a href="{{ route('staffs.index') }}" class="btn btn-danger float-left">{{__('messages.cancel')}}</a>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
