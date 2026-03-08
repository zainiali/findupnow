@extends('admin.master_layout')
@section('title')
    <title>{{ __('Support Ticket') }}</title>
@endsection
@section('admin-content')
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
                                                        <small>({{ __('Administrator') }})</small>
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

                                <div class="message-box mt-4">
                                    <form action="{{ route('admin.store-ticket-message') }}" method="POST"
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
                                        href="{{ route('admin.booking-show', $ticket->order->order_id ?? 0) }}">{{ $ticket->order->order_id ?? '' }}</a>
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

                                <h6 class="mt-3">{{ __('User Information') }}</h6>
                                <hr>

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

                                <a class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal"
                                    href="javascript:;" onclick="deleteData({{ $ticket->id }})"><i class="fa fa-trash"
                                        aria-hidden="true"></i> {{ __('Delete') }}</a>

                                @if ($ticket->status != 'closed')
                                    <a class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#closeTicket"
                                        href="javascript:;"><i class="fa fa-times" aria-hidden="true"></i>
                                        {{ __('Closed') }}</a>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <div class="modal fade" id="closeTicket" role="dialog" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('Ticket Closed Confirmation') }}</h5>
                    <button class="btn btn-danger" data-bs-dismiss="modal" type="button" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>{{ __('Are You sure closed this ticket ?') }}</p>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <form action="{{ route('admin.ticket-closed', $ticket->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <button class="btn btn-primary" type="submit">{{ __('Yes, Closed') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <x-admin.delete-modal />

    <script>
        "use strict";

        function deleteData(id) {
            $("#deleteForm").attr("action", '{{ url('admin/ticket-delete/') }}' + "/" + id)
        }
    </script>
@endsection
