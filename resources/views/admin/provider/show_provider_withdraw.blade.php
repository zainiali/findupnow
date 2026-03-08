@extends('admin.master_layout')
@section('title')
    <title>{{ __('Withdraw Details') }}</title>
@endsection
@section('admin-content')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('Withdraw Details') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a>
                    </div>
                    <div class="breadcrumb-item">{{ __('Withdraw Details') }}</div>
                </div>
            </div>

            <div class="section-body">
                <a class="btn btn-primary" href="{{ route('admin.provider-withdraw') }}"><i class="fas fa-list"></i>
                    {{ __('Provider withdraw') }}</a>
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <table class="table table-bordered table-striped table-hover">
                                    <tr>
                                        <td width="50%">{{ __('Provider') }}</td>
                                        <td width="50%">
                                            <a
                                                href="{{ route('admin.provider-show', $withdraw->user_id) }}">{{ $withdraw->provider->name }}</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="50%">{{ __('Withdraw Method') }}</td>
                                        <td width="50%">{{ $withdraw->method }}</td>
                                    </tr>

                                    <tr>
                                        <td width="50%">{{ __('Withdraw Charge') }}</td>
                                        <td width="50%">{{ $withdraw->withdraw_charge }}%</td>
                                    </tr>

                                    <tr>
                                        <td width="50%">{{ __('Withdraw Charge Amount') }}</td>
                                        <td width="50%">
                                            {{ currency($withdraw->withdraw_charge_amount) }}
                                        </td>
                                    </tr>

                                    <tr>
                                        <td width="50%">{{ __('Total amount') }}</td>
                                        <td width="50%">
                                            {{ currency($withdraw->total_amount) }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="50%">{{ __('Withdraw amount') }}</td>
                                        <td width="50%">
                                            {{ currency($withdraw->withdraw_amount) }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="50%">{{ __('Status') }}</td>
                                        <td width="50%">
                                            @if ($withdraw->status == 1)
                                                <span class="badge badge-success">{{ __('Success') }}</span>
                                            @else
                                                <span class="badge badge-danger">{{ __('Pending') }}</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="50%">{{ __('Requested Date') }}</td>
                                        <td width="50%">{{ $withdraw->created_at->format('Y-m-d') }}</td>
                                    </tr>
                                    @if ($withdraw->status == 1)
                                        <tr>
                                            <td width="50%">{{ __('Approved Date') }}</td>
                                            <td width="50%">{{ $withdraw->approved_date }}</td>
                                        </tr>
                                    @endif

                                    <tr>
                                        <td width="50%">{{ __('Account Information') }}</td>
                                        <td width="50%">
                                            {!! clean(nl2br($withdraw->account_info)) !!}
                                        </td>
                                    </tr>

                                </table>

                                @if ($withdraw->status == 0)
                                    <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#withdrawApproved"
                                        href="javascript:;">{{ __('Approve withdraw') }}</i></a>
                                @endif

                                <a class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal"
                                    href="javascript:;"
                                    onclick="deleteData({{ $withdraw->id }})">{{ __('Delete withdraw request') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
    </div>

    <div class="modal fade" id="withdrawApproved" role="dialog" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('Withdraw Approved Confirmation') }}</h5>
                    <button class="btn btn-danger" data-dismiss="modal" type="button" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>{{ __('Are You sure approved this withdraw request ?') }}</p>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <form action="{{ route('admin.approved-provider-withdraw', $withdraw->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <button class="btn btn-danger" data-dismiss="modal" type="button">{{ __('Close') }}</button>
                        <button class="btn btn-primary" type="submit">{{ __('Yes, Approve') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <x-admin.delete-modal />

    <script>
        "use strict";

        function deleteData(id) {
            $("#deleteForm").attr("action", '{{ url('admin/delete-provider-withdraw/') }}' + "/" + id)
        }
    </script>
@endsection
