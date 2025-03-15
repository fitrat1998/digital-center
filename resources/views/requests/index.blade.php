@extends('adminsuper.layouts.admin')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{__('messages.requests.title')}}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('index') }}">{{__('messages.home')}}</a></li>
                        <li class="breadcrumb-item active">{{__('messages.requests.title')}}</li>
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
                        <h3 class="card-title">{{__('messages.requests.title')}}</h3>
                        @can('user.add')
                            <a href="{{ route('requests.create') }}" class="btn btn-success btn-sm float-right">
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

                                <th>{{__('messages.requests.fullname')}}</th>
                                <th>{{__('messages.requests.text')}}</th>
                                <th>{{__('messages.requests.file')}}</th>
                                <th>{{__('messages.requests.faculty')}}</th>
                                <th>{{__('messages.departments.title')}}</th>
                                <th class="w-25">{{__('messages.action')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($requests as $request)
                                <tr>
                                    <td>{{ $request->id }}</td>
                                    <td>{{ $request->fullname }}</td>
                                    <td>{{ $request->text }}</td>
                                    <td>{{ $request->file }}</td>
                                    <td>{{ $request->faculty }}</td>
                                    <td>{{ $request->department['name_' . app()->getLocale()] }}</td>
                                    <td class="text-center">
                                        @can('user.edit')
{{--                                            @if($request->exists($request->id))--}}
                                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal"
                                                        data-target="#acceptModal-{{ $request->id }}">
                                                    <i class="fa-solid fa-check"></i> Qabul qilish
                                                </button>

                                                <button type="button" class="btn btn-warning btn-sm" data-toggle="modal"
                                                        data-target="#rejectModal-{{ $request->id }}">
                                                    <i class="fa-solid fa-times"></i> Rad etish
                                                </button>
{{--                                            @endif--}}
                                        @endcan
                                    </td>

                                    <div class="modal fade" id="acceptModal-{{ $request->id }}" tabindex="-1"
                                         role="dialog">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">So‘rovni qabul qilish</h5>
                                                    <button type="button" class="close" data-dismiss="modal">&times;
                                                    </button>
                                                </div>
                                                <form action="{{ route('requests.accept', $request->id) }}"
                                                      method="post">
                                                    @csrf
                                                    <input type="hidden" value="{{ $request->id }}" name="accept_id">
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label>Izoh (ixtiyoriy):</label>
                                                            <textarea name="comment" class="form-control"
                                                                      rows="3"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-success">Ha, qabul
                                                            qilaman
                                                        </button>
                                                        <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Bekor qilish
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal fade" id="rejectModal-{{ $request->id }}" tabindex="-1"
                                         role="dialog">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">So‘rovni rad etish</h5>
                                                    <button type="button" class="close" data-dismiss="modal">&times;
                                                    </button>
                                                </div>
                                                <form action="{{ route('requests.reject', $request->id) }}"
                                                      method="post">
                                                    @csrf
                                                    <input type="hidden" value="{{ $request->id }}" name="reject_id">
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label>Rad etish sababi:</label>
                                                            <textarea name="reason" class="form-control" rows="3"
                                                                      required></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-warning">Ha, rad qilaman
                                                        </button>
                                                        <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Bekor qilish
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>


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
