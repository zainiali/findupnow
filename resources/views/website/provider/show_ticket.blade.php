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
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-body ticket-message">
                                <div class="list-group">
                                    @foreach ($messages as $message)
                                        @if ($message->admin_id == 0)
                                            <div
                                                class="list-group-item list-group-item-action flex-column align-items-start author_message mb-2">
                                                <div class="d-flex w-100 justify-content-between">
                                                    <h6 class="mb-1"> {{ $ticket->user->name }}
                                                        <small>({{ __('Author') }})</small>
                                                    </h6>
                                                    <small>{{ $message->created_at->diffForHumans() }}</small>
                                                </div>
                                                <p class="mb-1">{!! html_decode(clean(nl2br($message->message))) !!}</p>

                                                @if ($message->documents)
                                                    <div class="gallery">
                                                        @foreach ($message->documents as $document)
                                                            <a class="upload_photo"
                                                                href="{{ route('download-file', $document->file_name) }}"><i
                                                                    class="fas fa-link"></i> {{ $document->file_name }}</a>
                                                        @endforeach
                                                    </div>
                                                @endif

                                            </div>
                                        @else
                                            <div
                                                class="list-group-item list-group-item-action flex-column align-items-start mb-2">
                                                <div class="d-flex w-100 justify-content-between">
                                                    <h6 class="mb-1">{{ $message->admin ? $message->admin->name : '' }}
                                                        <small>({{ __('Admin') }})</small>
                                                    </h6>
                                                    <small>{{ $message->created_at->diffForHumans() }} </small>
                                                </div>
                                                <p class="mb-1">{!! html_decode(clean(nl2br($message->message))) !!}</p>

                                                @if ($message->documents)
                                                    <div class="gallery">
                                                        @foreach ($message->documents as $document)
                                                            <a class="upload_photo"
                                                                href="{{ route('download-file', $document->file_name) }}"><i
                                                                    class="fas fa-link"></i> {{ $document->file_name }}</a>
                                                        @endforeach
                                                    </div>
                                                @endif

                                            </div>
                                        @endif
                                    @endforeach

                                </div>

                                @if ($ticket->status != 'closed')
                                    <div class="message-box mt-4">
                                        <form action="{{ route('provider.store-ticket-message') }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group">
                                                <textarea class="form-control text-area-5" id="" name="message" required placeholder="{{ __('Type here') }}.."
                                                    cols="30" rows="10"></textarea>
                                            </div>
                                            <input name="ticket_id" type="hidden" value="{{ $ticket->id }}">
                                            <input name="user_id" type="hidden" value="{{ $ticket->user->id }}">
                                            <div class="form-group">
                                                <input class="form-control" name="documents[]" type="file" multiple>
                                                <span class="text-danger">{{ __('Maximum file size 2MB') }}</span>
                                            </div>

                                            <button class="btn btn-primary" type="submit">{{ __('Submit') }}</button>
                                        </form>
                                    </div>
                                @endif

                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h6>{{ __('Ticket Information') }}</h6>
                                <hr>
                                <p>{{ __('Subject') }}: {{ html_decode($ticket->subject) }}</p>
                                <p>{{ __('Ticket Id') }}: {{ $ticket->ticket_id }}</p>
                                <p>{{ __('Booking Id') }}: <a
                                        href="{{ route('provider.booking-show', $ticket->order->order_id ?? 0) }}">{{ $ticket->order->order_id ?? '' }}</a>
                                </p>
                                <p>{{ __('Created') }}: {{ $ticket->created_at->format('h:m A, d-M-Y') }}</p>
                                <p>{{ __('Status') }}:
                                    @if ($ticket->status == 'pending')
                                        <span class="badge badge-danger">{{ __('Pending') }}</span>
                                    @elseif ($ticket->status == 'in_progress')
                                        <span class="badge badge-success">{{ __('In Progress') }}</span>
                                    @elseif ($ticket->status == 'closed')
                                        <span class="badge badge-danger">{{ __('Closed') }}</span>
                                    @endif
                                </p>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection
