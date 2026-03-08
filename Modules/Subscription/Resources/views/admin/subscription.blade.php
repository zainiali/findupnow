@extends('admin.master_layout')
@section('title')
    <title>{{ __('Subscription Plan') }}</title>
@endsection
@section('admin-content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('Subscription Plan') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a>
                    </div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">

                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>

                                    <a class="btn btn-primary" href="{{ route('admin.subscription-plan.create') }}"><i
                                            class="fa fa-plus"></i>
                                        {{ __('Add New') }}</a>
                                </h4>

                            </div>
                            <div class="card-body text-center">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <tr>
                                            <th>{{ __('Serial') }}</th>
                                            <th>{{ __('Name') }}</th>
                                            <th>{{ __('Price') }}</th>
                                            <th>{{ __('Expiration') }}</th>
                                            <th>{{ __('Status') }}</th>
                                            <th>{{ __('Action') }}</th>
                                        </tr>

                                        @foreach ($plans as $index => $plan)
                                            <tr>
                                                <td>{{ $plan->serial }}</td>
                                                <td>{{ $plan->plan_name }}</td>
                                                <td>{{ $setting->currency_icon }}{{ $plan->plan_price }}</td>
                                                <td>{{ $plan->expiration_date }}</td>

                                                <td>
                                                    @if ($plan->status == 1)
                                                        <div class="badge badge-success">{{ __('Active') }}</div>
                                                    @else
                                                        <div class="badge badge-danger">{{ __('Inactive') }}</div>
                                                    @endif
                                                </td>

                                                <td>
                                                    <a class="btn btn-primary btn-sm"
                                                        href="{{ route('admin.subscription-plan.edit', $plan->id) }}"><i
                                                            class="fa fa-edit"></i></a>
                                                    @if ($plan->SubscriptionPlan->count() == 0)
                                                        <a class="btn btn-danger btn-sm delete"
                                                            data-url="{{ route('admin.subscription-plan.destroy', $plan->id) }}"
                                                            href=""><i class="fa fa-trash"></i></a>
                                                    @else
                                                        <a class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                            data-bs-target="#canNotDeleteModal" href="javascript:;"
                                                            disabled><i
                                                                class="fa fa-trash" aria-hidden="true"></i></a>
                                                    @endif

                                                </td>
                                            </tr>
                                        @endforeach

                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </section>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="canNotDeleteModal" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true"
        tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    {{ __('You can not delete this Plan. Because there are one or more Plan has been Purcheced.') }}
                </div>

                <div class="modal-footer">
                    <button class="btn btn-danger" data-dismiss="modal" type="button">{{ __('Close') }}</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="delete" role="dialog" tabindex="-1">
        <div class="modal-dialog" role="document">
            <form action="" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ __('Delete Plan') }}</h5>
                        <button class="btn btn-sm btn-danger" data-dismiss="modal" type="button" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p class="text-danger">{{ __('Are You Sure to Delete this Plan ?') }}</p>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-danger" data-dismiss="modal" type="button">{{ __('Close') }}</button>
                        <button class="btn btn-success" type="submit">{{ __('Yes, Delete') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        $(function() {
            'use strict'

            $('.delete').on('click', function(e) {
                e.preventDefault();
                const modal = $('#delete');
                modal.find('form').attr('action', $(this).data('url'));
                modal.modal('show');
            })
        })
    </script>
@endsection
