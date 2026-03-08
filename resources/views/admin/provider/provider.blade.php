@extends('admin.master_layout')
@section('title')
    <title>{{ __('Provider List') }}</title>
@endsection
@section('admin-content')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('Provider List') }}</h1>

            </div>

            <div class="section-body">
                <a class="btn btn-primary"
                    href="{{ route('admin.send-email-to-all-provider') }}">{{ __('Send email to all provider') }}</a>
                <div class="row mt-4">
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive table-invoice">
                                    <table class="table table-striped" id="dataTable">
                                        <thead>
                                            <tr>
                                                <th>{{ __('SN') }}</th>
                                                <th>{{ __('Provider Name') }}</th>
                                                <th>{{ __('Email') }}</th>
                                                <th>{{ __('Status') }}</th>
                                                <th>{{ __('Action') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($providers as $index => $provider)
                                                <tr>
                                                    <td>{{ ++$index }}</td>
                                                    <td>{{ html_decode($provider->name) }}</td>
                                                    <td>{{ html_decode($provider->email) }}</td>
                                                    <td>
                                                        @if ($provider->status == 1)
                                                            <a href="javascript:;"
                                                                onclick="manageCustomerStatus({{ $provider->id }})">
                                                                <input id="status_toggle" data-toggle="toggle"
                                                                    data-on="{{ __('Active') }}"
                                                                    data-off="{{ __('Inctive') }}" data-onstyle="success"
                                                                    data-offstyle="danger" type="checkbox" checked>
                                                            </a>
                                                        @else
                                                            <a href="javascript:;"
                                                                onclick="manageCustomerStatus({{ $provider->id }})">
                                                                <input id="status_toggle" data-toggle="toggle"
                                                                    data-on="{{ __('Active') }}"
                                                                    data-off="{{ __('InActive') }}" data-onstyle="success"
                                                                    data-offstyle="danger" type="checkbox">
                                                            </a>
                                                        @endif
                                                    </td>
                                                    <td>

                                                        <a class="btn btn-primary btn-sm"
                                                            href="{{ route('admin.provider-show', $provider->id) }}"><i
                                                                class="fa fa-eye" aria-hidden="true"></i></a>

                                                        <a class="btn btn-success btn-sm"
                                                            href="{{ route('admin.send-email-to-provider', $provider->id) }}"><i
                                                                class="far fa-envelope" aria-hidden="true"></i></a>

                                                        <a class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                            data-bs-target="#deleteModal" href="javascript:;"
                                                            onclick="deleteData({{ $provider->id }})"><i
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

    <!-- Modal -->
    <div class="modal fade" id="canNotDeleteModal" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true"
        tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    {{ __('You can not delete this seller. Because there are one or more products and shop account has been created in this seller.') }}
                </div>

                <div class="modal-footer">
                    <button class="btn btn-danger" data-dismiss="modal" type="button">{{ __('Close') }}</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        "use strict";

        function deleteData(id) {
            $("#deleteForm").attr("action", "{{ url('admin/provider-delete/') }}" + "/" + id)
        }

        function manageCustomerStatus(id) {
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
                url: "{{ url('/admin/provider-status/') }}" + "/" + id,
                success: function(response) {
                    toastr.success(response)
                },
                error: function(err) {

                }
            })
        }
    </script>
@endsection
