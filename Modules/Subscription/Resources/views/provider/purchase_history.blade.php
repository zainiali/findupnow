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

                            <div class="card-body text-center">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <tr>
                                            <th>{{ __('Serial') }}</th>
                                            <th>{{ __('Plan') }}</th>
                                            <th>{{ __('Expiration') }}</th>
                                            <th>{{ __('Expired Date') }}</th>
                                            <th>{{ __('Status') }}</th>
                                            <th>{{ __('Payment') }}</th>
                                            <th>{{ __('Action') }}</th>
                                        </tr>

                                        @foreach ($histories as $index => $history)
                                            <tr>
                                                <td>{{ ++$index }}</td>

                                                <td>{{ $history->plan_name }}</td>

                                                <td>{{ $history->expiration }}</td>
                                                <td>{{ $history->expiration_date }}</td>

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
                                                        href="{{ route('provider.purchase-history-show', $history->id) }}"><i
                                                            class="fa fa-eye"></i></a>

                                                    @if ($history->payment_status == 'pending')
                                                        <a class="m-1 btn btn-warning btn-sm"
                                                            href="{{ route('user.sub.complete.payment', ['id' => $history->id, 'type' => 'subscription']) }}"
                                                            title="{{ __('Complete Payment') }}"><i
                                                                class="fas fa-credit-card"></i></a>
                                                    @endif

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
@endsection
