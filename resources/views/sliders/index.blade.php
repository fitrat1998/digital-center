@extends('adminsuper.layouts.admin')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{__('messages.sliders.name')}}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('index') }}">{{__('messages.home')}}</a></li>
                        <li class="breadcrumb-item active">{{__('messages.sliders.name')}}</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{__('messages.sliders.name')}}</h3>
                        @can('user.add')
                            <a href="{{ route('sliders.create') }}" class="btn btn-success btn-sm float-right">
                                <span class="fas fa-plus-circle"></span>{{__('messages.crud.add')}}
                            </a>
                        @endcan
                    </div>
                    <div class="card-body">
                        <table id="dataTable"
                               class="table table-bordered table-striped dataTable dtr-inline table-responsive-lg">
                            <thead>
                            <tr>
                                <th>ID</th>

                                <th>{{__('messages.sliders.title')}} - <img src="{{ asset('uz.png') }}" alt="uz"
                                                                         width="24"></th>
                                <th>{{__('messages.sliders.title')}} - <img src="{{ asset('en.png') }}" alt="en"
                                                                         width="24"></th>
                                <th>{{__('messages.sliders.title')}} - <img src="{{ asset('ru.png') }}" alt="ru"
                                                                         width="24"></th>

                                <th>{{__('messages.sliders.caption')}} - <img src="{{ asset('uz.png') }}" alt="uz"
                                                                         width="24"></th>
                                <th>{{__('messages.sliders.caption')}} - <img src="{{ asset('en.png') }}" alt="en"
                                                                         width="24"></th>
                                <th>{{__('messages.sliders.caption')}} - <img src="{{ asset('ru.png') }}" alt="ru"
                                                                         width="24"></th>

                               <th>{{__('messages.sliders.photo')}}</th>

                                <th class="w-25">{{__('messages.action')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($sliders as $slider)
                                <tr>
                                    <td>{{ $slider->id }}</td>
                                    <td>{{ $slider->title_uz }}</td>
                                    <td>{{ $slider->title_en }}</td>
                                    <td>{{ $slider->title_ru }}</td>
                                    <td>{!!  $slider->caption_uz !!}</td>
                                    <td>{!!  $slider->caption_en !!}</td>
                                    <td>{!!  $slider->caption_ru !!}</td>
                                    <td><img src="{{ asset('storage/' . $slider->photo) }}" alt="Slider Photo" width="100"></td>
                                    <td class="text-center">
                                        @can('user.delete')
                                            <form action="{{ route('sliders.destroy', $slider->id) }}" method="post">
                                                @csrf
                                                <div class="btn-group">
                                                    @can('user.edit')
                                                        <a href="{{ route('sliders.edit', $slider->id) }}"
                                                           class="btn btn-primary btn-sm">
                                                            <i class="fa-solid fa-edit"></i>
                                                        </a>
                                                    @endcan
                                                    <input name="_method" type="hidden" value="DELETE">
                                                    <button type="button" class="btn btn-danger btn-sm"
                                                            onclick="if (confirm('Ishonchingiz komilmi?')) { this.form.submit() }">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </button>
                                                </div>
                                            </form>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
