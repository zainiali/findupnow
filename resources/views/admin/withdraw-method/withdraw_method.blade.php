@extends('admin.master_layout')
@section('title')
    <title>{{ __('Withdraw Method') }}</title>
@endsection
@section('admin-content')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('Withdraw Method') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a>
                    </div>
                    <div class="breadcrumb-item">{{ __('Withdraw Method') }}</div>
                </div>
            </div>

            <div class="section-body">
                <a class="btn btn-primary" href="{{ route('admin.withdraw-method.create') }}"><i class="fas fa-plus"></i>
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
                                                <th>{{ __('Name') }}</th>
                                                <th>{{ __('Minimum Amount') }}</th>
                                                <th>{{ __('Maximum Amount') }}</th>
                                                <th>{{ __('Charge') }}</th>
                                                <th>{{ __('Status') }}</th>
                                                <th>{{ __('Action') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($methods as $index => $method)
                                                <tr>
                                                    <td>{{ ++$index }}</td>
                                                    <td>{{ $method->name }}</td>
                                                    <td>
                                                        {{ currency($method->min_amount) }}
                                                    </td>
                                                    <td>
                                                        {{ currency($method->max_amount) }}
                                                    </td>
                                                    <td>{{ $method->withdraw_charge }}%</td>
                                                    <td>
                                                        @if ($method->status == 1)
                                                            <a href="javascript:;"
                                                                onclick="changeProductTaxStatus({{ $method->id }})">
                                                                <input id="status_toggle" data-toggle="toggle"
                                                                    data-on="{{ __('Active') }}"
                                                                    data-off="{{ __('Inactive') }}" data-onstyle="success"
                                                                    data-offstyle="danger" type="checkbox" checked>
                                                            </a>
                                                        @else
                                                            <a href="javascript:;"
                                                                onclick="changeProductTaxStatus({{ $method->id }})">
                                                                <input id="status_toggle" data-toggle="toggle"
                                                                    data-on="{{ __('Active') }}"
                                                                    data-off="{{ __('Inactive') }}" data-onstyle="success"
                                                                    data-offstyle="danger" type="checkbox">
                                                            </a>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a class="btn btn-primary btn-sm"
                                                            href="{{ route('admin.withdraw-method.edit', $method->id) }}"><i
                                                                class="fa fa-edit" aria-hidden="true"></i></a>
                                                        <a class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                            data-bs-target="#deleteModal" href="javascript:;"
                                                            onclick="deleteData({{ $method->id }})"><i
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
            $("#deleteForm").attr("action", "{{ url('admin/withdraw-method/') }}" + "/" + id)
        }

        function changeProductTaxStatus(id) {
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
                url: "{{ url('/admin/withdraw-method-status/') }}" + "/" + id,
                success: function(response) {
                    toastr.success(response)
                },
                error: function(err) {

                }
            })
        }
    </script>
@endsection
