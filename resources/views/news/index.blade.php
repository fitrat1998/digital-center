@extends('adminsuper.layouts.admin')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{__('messages.news.name')}}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('index') }}">{{__('messages.home')}}</a></li>
                        <li class="breadcrumb-item active">{{__('messages.news.name')}}</li>
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
                        <h3 class="card-title">{{__('messages.news.name')}}</h3>
                        @can('user.add')
                            <a href="{{ route('news.create') }}" class="btn btn-success btn-sm float-right">
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

                                <th>{{__('messages.news.title')}} - <img src="{{ asset('uz.png') }}" alt="uz"
                                                                         width="24"></th>
                                <th>{{__('messages.news.title')}} - <img src="{{ asset('en.png') }}" alt="en"
                                                                         width="24"></th>
                                <th>{{__('messages.news.title')}} - <img src="{{ asset('ru.png') }}" alt="ru"
                                                                         width="24"></th>

                                <th>{{__('messages.news.description')}} - <img src="{{ asset('uz.png') }}" alt="uz"
                                                                         width="24"></th>
                                <th>{{__('messages.news.description')}} - <img src="{{ asset('en.png') }}" alt="en"
                                                                         width="24"></th>
                                <th>{{__('messages.news.description')}} - <img src="{{ asset('ru.png') }}" alt="ru"
                                                                         width="24"></th>

                               <th>{{__('messages.news.photo')}}</th>

                                <th class="w-25">{{__('messages.action')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($news as $new)
                                <tr>
                                    <td>{{ $new->id }}</td>
                                    <td>{{ $new->title_uz }}</td>
                                    <td>{{ $new->title_en }}</td>
                                    <td>{{ $new->title_ru }}</td>
                                    <td>{!!  $new->description_uz !!}</td>
                                    <td>{!!  $new->description_en !!}</td>
                                    <td>{!!  $new->description_ru !!}</td>
                                    <td><img src="{{ asset('storage/' . $new->photo) }}" alt="Staff Photo" width="100"></td>
                                    <td class="text-center">
                                        @can('user.delete')
                                            <form action="{{ route('news.destroy', $new->id) }}" method="post">
                                                @csrf
                                                <div class="btn-group">
                                                    @can('user.edit')
                                                        <a href="{{ route('news.edit', $new->id) }}"
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
