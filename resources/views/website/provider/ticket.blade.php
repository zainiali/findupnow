@extends('website.provider.master_layout')
@section('title')
    <title>{{ __('Support Ticket') }}</title>
@endsection
@section('provider-content')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('Support Ticket') }}</h1>
            </div>

            <div class="section-body">
                <a class="btn btn-primary" href="{{ route('provider.create-new-ticket') }}"> <i class="fa fa-plus"
                        aria-hidden="true"></i> {{ __('Create Ticket') }}</a>
                <div class="row mt-4">
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive table-invoice">
                                    <table class="table table-striped report_table" id="dataTable">
                                        <thead>
                                            <tr>
                                                <th>{{ __('SN') }}</th>
                                                <th>{{ __('From') }}</th>
                                                <th>{{ __('Ticket Info') }}</th>
                                                <th>{{ __('Unread Message') }}</th>
                                                <th>{{ __('Status') }}</th>
                                                <th>{{ __('Action') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($tickets as $index => $ticket)
                                                <tr>
                                                    <td>{{ ++$index }}</td>
                                                    <td>
                                                        @if ($ticket->ticket_from == 'Client')
                                                            <p>
                                                                {{ __('Name') }}: <a
                                                                    href="{{ route('admin.customer-show', $ticket->user->id) }}">{{ $ticket->user->name }}</a>
                                                            </p>
                                                            <p>{{ __('User Type') }} : {{ __('Client') }}</p>
                                                            <p>{{ __('Email') }} : {{ $ticket->user->email }}</p>
                                                            <p>{{ __('Phone') }} : {{ $ticket->user->Phone }}</p>
                                                        @else
                                                            <p>
                                                                {{ __('Name') }}: <a
                                                                    href="{{ route('admin.provider-show', $ticket->user->id) }}">{{ $ticket->user->name }}</a>
                                                            </p>

                                                            <p>{{ __('User Type') }} : {{ __('Provider') }}</p>
                                                            <p>{{ __('Email') }} : {{ $ticket->user->email }}</p>
                                                            <p>{{ __('Phone') }} : {{ $ticket->user->Phone }}</p>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <p>{{ __('Subject') }}: {{ html_decode($ticket->subject) }}</p>
                                                        <p>{{ __('Ticket Id') }}: {{ $ticket->ticket_id }}</p>
                                                        <p>{{ __('Booking Id') }}: <a
                                                                href="{{ route('provider.booking-show', $ticket->order->order_id ?? 0) }}">{{ $ticket->order->order_id ?? '' }}</a>
                                                        </p>
                                                        <p>{{ __('Created') }}:
                                                            {{ $ticket->created_at->format('h:m A, d-M-Y') }}</p>
                                                    </td>

                                                    <td>
                                                        @php
                                                            $unseen = $ticket->messages
                                                                ->where('unseen_user', 0)
                                                                ->count();
                                                        @endphp
                                                        @if ($unseen > 0)
                                                            <span class="badge badge-danger">{{ $unseen }}</span>
                                                        @endif

                                                    </td>

                                                    <td>
                                                        @if ($ticket->status == 'pending')
                                                            <span class="badge badge-danger">{{ __('Pending') }}</span>
                                                        @elseif ($ticket->status == 'in_progress')
                                                            <span
                                                                class="badge badge-success">{{ __('In Progress') }}</span>
                                                        @elseif ($ticket->status == 'closed')
                                                            <span class="badge badge-danger">{{ __('Closed') }}</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a class="btn btn-primary btn-sm"
                                                            href="{{ route('provider.ticket-show', $ticket->ticket_id) }}"><i
                                                                class="fa fa-eye" aria-hidden="true"></i></a>

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
@endsection
