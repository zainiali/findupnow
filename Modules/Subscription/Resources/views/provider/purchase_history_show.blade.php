@extends('website.provider.master_layout')
@section('title')
    <title>{{ __('Purchase History') }}</title>
@endsection
@section('provider-content')

    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('Purchase History') }}</h1>
            </div>

            <div class="section-body">
                <div class="row">

                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card">
                            @if ($history->payment_status == 'pending')
                                <div class="card-header d-flex justify-content-end">
                                    <a class="m-1 btn btn-warning btn-sm"
                                        href="{{ route('user.sub.complete.payment', ['id' => $history->id, 'type' => 'subscription']) }}"
                                        title="{{ __('Complete Payment') }}"><i
                                            class="fas fa-credit-card"></i> {{ __('Complete Payment') }}</a>
                                </div>
                            @endif

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped">
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

                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </section>
    </div>

@endsection
