@extends('adminsuper.layouts.admin')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{__('messages.staffs.title')}}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('index') }}">{{__('messages.home')}}</a></li>
                        <li class="breadcrumb-item active">{{__('messages.staffs.title')}}</li>
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
                        <h3 class="card-title">{{__('messages.staffs.title')}}</h3>
                        @can('user.add')
                            <a href="{{ route('staffs.create') }}" class="btn btn-success btn-sm float-right">
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

                                <th>{{__('messages.staffs.title')}} - <img src="{{ asset('uz.png') }}" alt="uz" width="24"></th>
                                <th>{{__('messages.staffs.title')}} - <img src="{{ asset('en.png') }}" alt="en" width="24"></th>
                                <th>{{__('messages.staffs.title')}} - <img src="{{ asset('ru.png') }}" alt="ru" width="24"></th>
                                <th>{{__('messages.positions.title')}}</th>
                                <th class="w-25">{{__('messages.action')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($staffs as $staff)
                                <tr>
                                    <td>{{ $staff->id }}</td>
                                    <td>{{ $staff->name_uz }}</td>
                                    <td>{{ $staff->name_en }}</td>
                                    <td>{{ $staff->name_ru }}</td>
                                    <td>{{ $staff->department['name_' . app()->getLocale()] }}</td>
                                    <td class="text-center">
                                        @can('user.delete')
                                            <form action="{{ route('staffs.destroy', $staff->id) }}" method="post">
                                                @csrf
                                                <div class="btn-group">
                                                    @can('user.edit')
                                                        <a href="{{ route('staffs.edit', $staff->id) }}"
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
