<div class="row">
    <div class="col-xl-8">
        <div class="ticket_list_view_area dashboard_review">
            <a class="go_ticket"><i class="fas fa-long-arrow-alt-left"></i>
                {{ __('go back') }}</a>

            <div class="message-list">
                @foreach ($messages as $message)
                    @if ($message->admin_id == 0)
                        <div class="wsus__support_ticket_single author_message">
                            <h5>{{ $ticket->user->name }} <small>({{ __('Author') }})</small>
                                <span>{{ $message->created_at->diffForHumans() }}</span>
                            </h5>
                            <p>{!! html_decode(clean(nl2br($message->message))) !!}</p>

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
                        <div class="wsus__support_ticket_single">
                            <h5>{{ $message->admin ? $message->admin->name : '' }}
                                <small>({{ __('Administrator') }})</small>
                                <span>{{ $message->created_at->diffForHumans() }}</span>
                            </h5>
                            <p>{!! html_decode(clean(nl2br($message->message))) !!}</p>

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

            <form class="ticket_list_view_form" id="ticket_message_form">
                @csrf
                <textarea name="message" required rows="4" placeholder="{{ __('Typing Here') }}..."></textarea>
                <input name="documents[]" type="file" multiple>

                <input name="ticket_id" type="hidden" value="{{ $ticket->id }}">
                <input name="user_id" type="hidden" value="{{ $ticket->user->id }}">

                <p>{{ __('Maximum file size 2MB') }}</p>
                <button class="common_btn" type="submit">{{ __('Submit Now') }}</button>
            </form>
        </div>
    </div>
    <div class="col-xl-4">
        <div class="ticket_list_view_sidebar dashboard_review">
            <h4>{{ __('Ticket Information') }}</h4>

            <p>{{ __('Subject') }}: {{ html_decode($ticket->subject) }}</p>
            <p>{{ __('Ticket Id') }}: {{ $ticket->ticket_id }}</p>
            <p>{{ __('Booking Id') }}: <a href="javascript:;">{{ $ticket?->order?->order_id ?? '' }}</a></p>
            <p>{{ __('Created') }}: {{ $ticket->created_at->format('h:m A, d-M-Y') }}</p>
            <p>{{ __('Status') }}:
                @if ($ticket->status == 'pending')
                    <b><span class="closed">{{ __('Pending') }}</span></b>
                @elseif ($ticket->status == 'in_progress')
                    <b><span class="active">{{ __('In Progress') }}</span></b>
                @elseif ($ticket->status == 'closed')
                    <b><span class="closed">{{ __('Closed') }}</span></b>
                @endif
            </p>
        </div>
    </div>
</div>

<script>
    (function($) {
        "use strict";
        $(document).ready(function() {
            $(".go_ticket").on("click", function() {
                $(".support_ticket").fadeIn();
            });

            $(".go_ticket").on("click", function() {
                $(".wsus__ticket_list_view").fadeOut();
            });

            $("#ticket_message_form").on("submit", function(e) {
                e.preventDefault();

                var isDemo = "{{ env('APP_MODE') }}"
                if (isDemo == 'DEMO') {
                    toastr.error('This Is Demo Version. You Can Not Change Anything');
                    return;
                }

                $.ajax({
                    url: "{{ route('send-ticket-message') }}",
                    type: "post",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(response) {
                        $(".message-list").html(response)
                        $("#ticket_message_form").trigger("reset");
                    },
                    error: function(err) {

                    }
                });
            })

        });
    })(jQuery);
</script>
