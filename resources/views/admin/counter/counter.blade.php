@extends('admin.master_layout')
@section('title')
    <title>{{ __('Counter') }}</title>
@endsection
@section('admin-content')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('Counter') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a
                            href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></div>
                    <div class="breadcrumb-item">{{ __('Counter') }}</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row mt-4">
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('admin.update-counter-bg') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <label for="">{{ __('Existing Banner') }}</label>
                                        <div>
                                            <img class="w_180_h_100" src="{{ asset($counter_bg_image->counter_bg_image) }}"
                                                alt="">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="">{{ __('New Banner') }}</label>
                                        <input class="form-control" name="image" type="file">
                                    </div>

                                    <button class="btn btn-success" type="submit">{{ __('Update') }}</button>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="section-body">
                <a class="btn btn-primary" href="{{ route('admin.counter.create') }}"><i class="fas fa-plus"></i>
                    {{ __('Add New') }}</a>
                <div class="row mt-4">
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive table-invoice">
                                    <table class="table table-striped" id="dataTable">
                                        <thead>
                                            <tr>
                                                <th>{{ __('SN') }}</th>
                                                <th width="20%">{{ __('Title') }}</th>
                                                <th width="10%">{{ __('Icon') }}</th>
                                                <th width="30%">{{ __('Number') }}</th>
                                                <th>{{ __('Status') }}</th>
                                                <th>{{ __('Action') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($counters as $index => $counter)
                                                <tr>
                                                    <td>{{ ++$index }}</td>
                                                    <td>{{ $counter->title }}</td>
                                                    <td>
                                                        <img class="w_80" src="{{ asset($counter->icon) }}"
                                                            alt="">
                                                    </td>
                                                    <td>{{ $counter->number }}</td>
                                                    <td>
                                                        @if ($counter->status == 1)
                                                            <a href="javascript:;"
                                                                onclick="changeServiceStatus({{ $counter->id }})">
                                                                <input id="status_toggle" data-toggle="toggle"
                                                                    data-on="{{ __('Active') }}"
                                                                    data-off="{{ __('InActive') }}" data-onstyle="success"
                                                                    data-offstyle="danger" type="checkbox" checked>
                                                            </a>
                                                        @else
                                                            <a href="javascript:;"
                                                                onclick="changeServiceStatus({{ $counter->id }})">
                                                                <input id="status_toggle" data-toggle="toggle"
                                                                    data-on="{{ __('Active') }}"
                                                                    data-off="{{ __('InActive') }}" data-onstyle="success"
                                                                    data-offstyle="danger" type="checkbox">
                                                            </a>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a class="btn btn-primary btn-sm"
                                                            href="{{ route('admin.counter.edit', $counter->id) }}"><i
                                                                class="fa fa-edit" aria-hidden="true"></i></a>
                                                        <a class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                            data-bs-target="#deleteModal" href="javascript:;"
                                                            onclick="deleteData({{ $counter->id }})"><i
                                                                class="fa fa-trash" aria-hidden="true"></i></a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
    </div>

    <x-admin.delete-modal />

    <script>
        "use strict";

        function deleteData(id) {
            $("#deleteForm").attr("action", '{{ url('admin/counter/') }}' + "/" + id)
        }

        function changeServiceStatus(id) {
            var isDemo = "{{ env('APP_MODE') }}"
            if (isDemo == 'DEMO') {
                toastr.error('This Is Demo Version. You Can Not Change Anything');
                return;
            }
            $.ajax({
                type: "put",
                data: {
                    _token: '{{ csrf_token() }}'
                },
                url: "{{ url('/admin/counter-status/') }}" + "/" + id,
                success: function(response) {
                    toastr.success(response)
                },
                error: function(err) {

                }
            })
        }
    </script>
@endsection
