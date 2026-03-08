@extends('admin.master_layout')
@section('title')
    <title>{{ __('Provider withdraw') }}</title>
@endsection
@section('admin-content')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('Provider withdraw') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a
                            href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></div>
                    <div class="breadcrumb-item">{{ __('Provider withdraw') }}</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row mt-4">
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive table-invoice">
                                    <table class="table table-striped" id="dataTable">
                                        <thead>
                                            <tr>
                                                <th>{{ __('SN') }}</th>
                                                <th>{{ __('Provider') }}</th>
                                                <th>{{ __('Method') }}</th>
                                                <th>{{ __('Charge') }}</th>
                                                <th>{{ __('Total Amount') }}</th>
                                                <th>{{ __('Withdraw Amount') }}</th>
                                                <th>{{ __('Status') }}</th>
                                                <th>{{ __('Action') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($withdraws as $index => $withdraw)
                                                <tr>
                                                    <td>{{ ++$index }}</td>
                                                    <td>
                                                        <a
                                                            href="{{ route('admin.provider-show', $withdraw->user_id) }}">{{ $withdraw->provider->name ?? '' }}</a>
                                                    </td>
                                                    <td>{{ $withdraw->method }}</td>
                                                    <td>
                                                        {{ currency($withdraw->total_amount - $withdraw->withdraw_amount) }}
                                                    </td>
                                                    <td>
                                                        {{ currency($withdraw->total_amount) }}
                                                    </td>
                                                    <td>
                                                        {{ currency($withdraw->withdraw_amount) }}
                                                    </td>
                                                    <td>
                                                        @if ($withdraw->status == 1)
                                                            <span
                                                                class="badge badge-success">{{ __('Success') }}</span>
                                                        @else
                                                            <span
                                                                class="badge badge-danger">{{ __('Pending') }}</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a class="btn btn-primary btn-sm"
                                                            href="{{ route('admin.show-provider-withdraw', $withdraw->id) }}"><i
                                                                class="fa fa-eye" aria-hidden="true"></i></a>

                                                        <a class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                            data-bs-target="#deleteModal" href="javascript:;"
                                                            onclick="deleteData({{ $withdraw->id }})"><i
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
            $("#deleteForm").attr("action", '{{ url('admin/delete-provider-withdraw/') }}' + "/" + id)
        }
    </script>
@endsection
