@extends('adminsuper.layouts.admin')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{__('messages.positions.title')}}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('index') }}">{{__('messages.home')}}</a></li>
                        <li class="breadcrumb-item active">{{__('messages.positions.title')}}</li>
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
                        <h3 class="card-title">{{__('messages.positions.title')}}</h3>
                        @can('user.add')
                            <a href="{{ route('positions.create') }}" class="btn btn-success btn-sm float-right">
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

                                <th>{{__('messages.positions.name')}} - <img src="{{ asset('uz.png') }}" alt="uz" width="24"></th>
                                <th>{{__('messages.positions.name')}} - <img src="{{ asset('en.png') }}" alt="en" width="24"></th>
                                <th>{{__('messages.positions.name')}} - <img src="{{ asset('ru.png') }}" alt="ru" width="24"></th>
                                <th>{{__('messages.departments.title')}}</th>
                                <th class="w-25">{{__('messages.action')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($positions as $position)
                                <tr>
                                    <td>{{ $position->id }}</td>
                                    <td>{{ $position->name_uz }}</td>
                                    <td>{{ $position->name_en }}</td>
                                    <td>{{ $position->name_ru }}</td>
                                    <td>{{ $position->department['name_' . app()->getLocale()] }}</td>
                                    <td class="text-center">
                                        @can('user.delete')
                                            <form action="{{ route('positions.destroy', $position->id) }}" method="post">
                                                @csrf
                                                <div class="btn-group">
                                                    @can('user.edit')
                                                        <a href="{{ route('positions.edit', $position->id) }}"
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
