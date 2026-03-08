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

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <tr>
                                            <td>{{ __('Provider') }}</td>
                                            <td><a
                                                    href="{{ route('admin.provider-show', $history->provider_id) }}">{{ $history->provider->name }}</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('Plan') }}</td>
                                            <td>{{ $history->plan_name }}</td>
                                        </tr>

                                        <tr>
                                            <td>{{ __('Expiration') }}</td>
                                            <td>{{ $history->expiration }}</td>
                                        </tr>

                                        <tr>
                                            <td>{{ __('Expirated Date') }}</td>
                                            <td>{{ $history->expiration_date }}</td>
                                        </tr>

                                        <tr>
                                            <td>{{ __('Remaining day') }}</td>
                                            <td>
                                                @if ($history->status == 'active')
                                                    @if ($history->expiration_date == 'lifetime')
                                                        {{ __('Lifetime') }}
                                                    @else
                                                        @php
                                                            $date1 = new DateTime(date('Y-m-d'));
                                                            $date2 = new DateTime($history->expiration_date);
                                                            $interval = $date1->diff($date2);
                                                            $remaining = $interval->days;
                                                        @endphp

                                                        @if ($remaining > 0)
                                                            {{ $remaining }} {{ __('Days') }}
                                                        @else
                                                            {{ __('Expired') }}
                                                        @endif
                                                    @endif
                                                @else
                                                    {{ __('Expired') }}
                                                @endif
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>{{ __('Number of service') }}</td>
                                            <td>{{ $history->maximum_service }}</td>
                                        </tr>

                                        <tr>
                                            <td>{{ __('Payment Method') }}</td>
                                            <td>{{ $history->payment_method }}</td>
                                        </tr>

                                        <tr>
                                            <td>{{ __('Transaction') }}</td>
                                            <td>{!! nl2br($history->transaction) !!}</td>
                                        </tr>

                                        @if ($history->payment_method == 'bank')
                                            <tr>
                                                <td>
                                                    {{ __('Bank') }}
                                                </td>
                                                <td>
                                                    <pre>{{ json_encode(json_decode($history->payment_details ?? '{}'), JSON_PRETTY_PRINT) }}</pre>
                                                </td>
                                            </tr>
                                        @endif

                                        <tr>
                                            <td>{{ __('Status') }}</td>
                                            <td>
                                                @if ($history->status == 'active')
                                                    <div class="badge badge-success">{{ __('Active') }}</div>
                                                @elseif ($history->status == 'pending')
                                                    <div class="badge badge-danger">{{ __('Pending') }}</div>
                                                @elseif ($history->status == 'expired')
                                                    <div class="badge badge-danger">{{ __('Expired') }}</div>
                                                @endif
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                {{ __('Payment') }}
                                            </td>
                                            <td>
                                                @if ($history->payment_status == 'success')
                                                    <div class="badge badge-success">{{ __('Success') }}</div>
                                                @else
                                                    <div class="badge badge-danger">{{ __('Pending') }}</div>
                                                @endif
                                            </td>
                                        </tr>

                                    </table>
                                </div>

                                <a class="btn btn-danger delete"
                                    data-url="{{ route('admin.delete-plan-payment', $history->id) }}"
                                    href="">{{ __('Delete') }}</a>

                                @if (
                                    ($history->payment_status == 'pending' && $history->status == 'pending') ||
                                        ($history->payment_method == 'bank' && $history->payment_status == 'success' && $history->status == 'pending'))
                                    <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#paymentUpdate"
                                        href="javascript:;">{{ __('Payment approved') }}</a>
                                @endif

                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </section>
    </div>

    @if (
        ($history->payment_status == 'pending' && $history->status == 'pending') ||
            ($history->payment_method == 'bank' && $history->payment_status == 'success' && $history->status == 'pending'))
        <!-- Modal -->
        <div class="modal fade" id="paymentUpdate" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true"
            tabindex="-1">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ __('Payment Approved') }}</h5>
                        <button class="btn btn-sm btn-danger" data-dismiss="modal" type="button" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <p class="text-danger">{{ __('Are you sure approved this payment ?') }}</p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-dismiss="modal" type="button">{{ __('Close') }}</button>

                        <form action="{{ route('admin.approved-plan-payment', $history->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <button class="btn btn-primary" type="submit">{{ __('Yes, Approved') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif

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
