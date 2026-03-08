@extends('admin.master_layout')
@section('title')
    <title>{{ __('Purchase History') }}</title>
@endsection
@section('admin-content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('Purchase History') }}</h1>

            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>

                                    <a class="btn btn-primary" href="{{ route('admin.assign-plan') }}"><i
                                            class="fa fa-plus"></i>{{ __('Assign Plan') }}</a>
                                </h4>

                            </div>
                            <div class="card-body text-center">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <tr>
                                            <th>{{ __('Serial') }}</th>
                                            <th>{{ __('Provider') }}</th>
                                            <th>{{ __('Plan') }}</th>
                                            <th>{{ __('Expiration') }}</th>
                                            <th>{{ __('Status') }}</th>
                                            <th>{{ __('Payment') }}</th>
                                            <th>{{ __('Action') }}</th>
                                        </tr>

                                        @foreach ($histories as $index => $history)
                                            <tr>
                                                <td>{{ ++$index }}</td>
                                                <td><a
                                                        href="{{ route('admin.provider-show', $history->provider_id) }}">{{ $history->provider->name }}</a>
                                                </td>
                                                <td>{{ $history->plan_name }}</td>

                                                <td>{{ $history->expiration }}</td>

                                                <td>
                                                    @if ($history->status == 'active')
                                                        <div class="badge badge-success">{{ __('Active') }}</div>
                                                    @elseif ($history->status == 'pending')
                                                        <div class="badge badge-danger">{{ __('Pending') }}</div>
                                                    @elseif ($history->status == 'expired')
                                                        <div class="badge badge-danger">{{ __('Expired') }}</div>
                                                    @endif
                                                </td>

                                                <td>
                                                    @if ($history->payment_status == 'success')
                                                        <div class="badge badge-success">{{ __('Success') }}</div>
                                                    @else
                                                        <div class="badge badge-danger">{{ __('Pending') }}</div>
                                                    @endif
                                                </td>

                                                <td>
                                                    <a class="btn btn-primary btn-sm"
                                                        href="{{ route('admin.purchase-history-show', $history->id) }}"><i
                                                            class="fa fa-eye"></i></a>
                                                    <a class="btn btn-danger btn-sm delete"
                                                        data-url="{{ route('admin.delete-plan-payment', $history->id) }}"
                                                        href=""><i class="fa fa-trash"></i></a>

                                                </td>
                                            </tr>
                                        @endforeach

                                    </table>
                                </div>
                            </div>

                            @if ($histories->hasPages())
                                <div class="card-footer d-flex justify-content-center">

                                    {{ $histories->links() }}

                                </div>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <div class="modal fade" id="delete" role="dialog" tabindex="-1">
        <div class="modal-dialog" role="document">
            <form action="" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ __('Delete Purchase History') }}</h5>
                        <button class="btn btn-sm btn-danger" data-dismiss="modal" type="button" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p class="text-danger">{{ __('Are You Sure to Delete this Plan?') }}</p>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-dismiss="modal" type="button">{{ __('Close') }}</button>
                        <button class="btn btn-danger" type="submit">{{ __('Yes, Delete') }}</button>
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
