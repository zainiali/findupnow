@extends('website.provider.master_layout')
@section('title')
    <title>{{ $title }}</title>
@endsection
@section('provider-content')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ $title }}</h1>
            </div>

            <div class="section-body">
                <div class="card">
                    <div class="card-body">
                        <form action="">
                            <div class="row">
                                <div class="col-md-10">
                                    <div class="form-group">
                                        <label for="">{{ __('Booking Id') }}</label>
                                        <input class="form-control" name="booking_id" type="text"
                                            value="{{ request()->has('booking_id') ? request()->get('booking_id') : '' }}"
                                            autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <button class="btn btn-primary plus_btn">{{ __('Search') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    @if ($orders->count() > 0)
                        @foreach ($orders as $order)
                            <div class="col-12">
                                <div class="card service_card order_card">
                                    <div class="card-body d-flex flex-wrap justify-content-between align-items-center">
                                        <img class="service_image" src="{{ asset($order->service->image) }}" alt="">
                                        <div class="service_detail">
                                            <h4>{{ $order->service->name }}</h4>
                                            <h6>{{ __('Price') }} :
                                                {{ currency($order->total_amount) }}
                                            </h6>
                                            <p>{{ __('Booking Id') }} : {{ $order->order_id }}</p>
                                            <p>{{ __('Booking Created') }} :
                                                {{ $order->created_at->format('h:i A, d-m-Y') }}</p>
                                            <p>{{ __('Schedule Date') }} : {{ $order->schedule_time_slot }},
                                                {{ date('d-M-Y', strtotime($order->booking_date)) }}</p>
                                            <p>{{ __('Client') }} : {{ $order->client->name }}</p>
                                            <p>{{ __('Phone') }} : {{ $order->client->phone }}</p>
                                            <p>{{ __('Status') }} :

                                                @if ($order->order_status == 'awaiting_for_provider_approval')
                                                    <span
                                                        class="badge badge-danger">{{ __('awaiting for provider approval') }}</span>
                                                @elseif ($order->order_status == 'approved_by_provider')
                                                    <span class="badge badge-success">{{ __('Approved') }}</span>
                                                @elseif ($order->order_status == 'order_decliened_by_provider')
                                                    <span
                                                        class="badge badge-danger">{{ __('Declined by provider') }}</span>
                                                @elseif ($order->order_status == 'order_decliened_by_client')
                                                    <span class="badge badge-danger">{{ __('Declined by Client') }}</span>
                                                @elseif ($order->order_status == 'complete')
                                                    <span class="badge badge-success">{{ __('Complete') }}</span>
                                                @endif
                                            </p>

                                            @if ($order->order_status == 'awaiting_for_provider_approval')
                                                <a class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#approvedOrder-{{ $order->id }}"
                                                    href="javascript:;"><i
                                                        class="fas fa-check"></i> {{ __('Approved') }}</a>

                                                <a class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#declinedOrder-{{ $order->id }}"
                                                    href="javascript:;"><i
                                                        class="fas fa-times"></i> {{ __('Declined') }}</a>
                                            @endif

                                            <a class="btn btn-success btn-sm"
                                                href="{{ route('provider.booking-show', $order->order_id) }}"><i
                                                    class="fas fa-eye"></i> {{ __('View') }}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="col-12 text-center text-danger">
                            <h4>{{ __('Booking not found!') }}</h4>
                        </div>
                    @endif

                    <div class="col-12">
                        {{ $orders->links() }}
                    </div>
                </div>
            </div>
        </section>
    </div>

    @foreach ($orders as $order)
        <div class="modal fade" id="declinedOrder-{{ $order->id }}" role="dialog" tabindex="-1">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ __('Booking Declined Confirmation') }}</h5>
                        <button class="btn btn-sm btn-danger" data-dismiss="modal" type="button" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>{{ __('Are You sure declined this booking') }}</p>
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                        <form action="{{ route('provider.booking-declined', $order->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <button class="btn btn-danger" data-dismiss="modal" type="button">{{ __('Close') }}</button>
                            <button class="btn btn-primary" type="submit">{{ __('Yes, Declined') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="approvedOrder-{{ $order->id }}" role="dialog" tabindex="-1">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ __('Booking Approved Confirmation') }}</h5>
                        <button class="btn btn-sm btn-danger" data-dismiss="modal" type="button" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>{{ __('Are You sure approved this booking') }}</p>
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                        <form action="{{ route('provider.booking-approved', $order->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <button class="btn btn-danger" data-dismiss="modal" type="button">{{ __('Close') }}</button>
                            <button class="btn btn-primary" type="submit">{{ __('Yes, Approved') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
