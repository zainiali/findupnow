@extends('website.provider.master_layout')
@section('title')
    <title>{{ __('Live Chat') }}</title>
@endsection
@section('provider-content')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('Live Chat') }}</h1>
            </div>

            <div class="section-body">
                <div class="row ustify-content-center">
                    <div class="col-12 col-sm-6 col-lg-4">
                        <div class="card">
                            <div class="card-header">
                                <h4>{{ __('Buyer List') }}</h4>
                            </div>
                            <div class="card-body seller_chat_list">
                                <ul class="list-unstyled list-unstyled-border" id="my_buyer_list">

                                    @foreach ($buyers as $buyer)
                                        <li class="media mt-2 buyer-list" id="customer-list-{{ $buyer->buyer_id }}"
                                            data-buyer-id="{{ $buyer->buyer_id }}" style="cursor: pointer"
                                            onclick="loadChatBox({{ $buyer->buyer_id }},'{{ $buyer->buyer->name }}')">
                                            @if ($buyer->buyer->image)
                                                <img class="mr-3 ml-3 rounded-circle"
                                                    src="{{ asset($buyer->buyer->image) }}" alt="image" width="50">
                                            @else
                                                <img class="mr-3 ml-3 rounded-circle"
                                                    src="{{ asset($default_avatar->image) }}" alt="image" width="50">
                                            @endif

                                            @php
                                                $un_read = App\Models\Message::where([
                                                    'provider_id' => $provider->id,
                                                    'buyer_id' => $buyer->buyer_id,
                                                    'provider_read_msg' => 0,
                                                ])->count();
                                            @endphp
                                            <span class="pending {{ $un_read == 0 ? 'd-none' : '' }}"
                                                id="pending-{{ $buyer->buyer_id }}">{{ $un_read }}</span>
                                            <div class="media-body mt-4">
                                                <div class="font-weight-bold">{{ $buyer->buyer->name }}</div>
                                            </div>
                                        </li>
                                    @endforeach

                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-lg-8">
                        <div class="card chat-box" id="mychatbox">
                            <div class="card-header buyer_name">
                                <h4>{{ __('Please choose one') }}</h4>
                            </div>

                            <div class="card-body chat-content">

                            </div>

                            <div class="card-footer chat-form">
                                <form id="chat-form">
                                    @csrf
                                    <input class="form-control" id="customer_message" name="message" type="text"
                                        autocomplete="off" placeholder="{{ __('Type message') }}" readonly>
                                    <input id="buyer_id" name="buyer_id" type="hidden">
                                    <button class="btn btn-primary send-message-button" type="submit" disabled>
                                        <i class="far fa-paper-plane"></i>
                                    </button>
                                </form>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </section>
    </div>

    @php
        $active_user_for_message = Auth::guard('web')->user();
    @endphp
@endsection

@section('message-box')
    <script src="{{ asset('global/js/axios.min.js') }}"></script>
    <script src="{{ asset('global/js/pusher.min.js') }}"></script>

    <script src="{{ asset('global/js/echo.iife.min.js') }}"></script>

    <script>
        window.axios = axios;
        window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

        window.PUSHER_CONFIG = {
            appUrl: "{{ url('/') }}",
            key: "{{ config('broadcasting.connections.pusher.key') }}",
            cluster: "{{ config('broadcasting.connections.pusher.options.cluster') }}",
            authEndpoint: "{{ url('/broadcasting/auth') }}"
        };

        // Echo config using dynamic settings
        window.Echo = new window.Echo({
            broadcaster: 'pusher',
            key: window.PUSHER_CONFIG.key,
            cluster: window.PUSHER_CONFIG.cluster,
            forceTLS: true,
            authorizer: function(channel, options) {
                return {
                    authorize: function(socketId, callback) {
                        axios.post(window.PUSHER_CONFIG.authEndpoint, {
                                socket_id: socketId,
                                channel_name: channel.name
                            })
                            .then(function(response) {
                                callback(false, response.data);
                            })
                            .catch(function(error) {
                                callback(true, error);
                            });
                    }
                };
            }
        });
    </script>

    <script>
        let active_buyer_id = 0;
        (function($) {
            "use strict";
            $(document).ready(function() {
                $("#chat-form").on("submit", function(e) {
                    e.preventDefault();
                    if ("{{ config('app.app_mode') }}" == 'DEMO') {
                        toastr.error("{{ __('This Is Demo Version. You Can Not Change Anything') }}");
                        return;
                    }
                    let message = $("#customer_message").val();
                    if (message == '') return;
                    $.ajax({
                        type: "post",
                        data: $('#chat-form').serialize(),
                        url: "{{ url('provider/send-message-to-buyer/') }}",
                        success: function(response) {
                            $(".chat-content").html(response)
                            $("#customer_message").val('');
                            scrollToBottomFunc();
                        },
                        error: function(err) {}
                    })
                })

                Echo.private("buyer-to-provider.{{ $active_user_for_message->id }}")
                    .listen('BuyerProviderMessage', (e) => {

                        let sender_buyer_id = e.message[0].buyer_id;

                        if (parseInt(sender_buyer_id) == parseInt(active_buyer_id)) {
                            $("#pending-" + sender_buyer_id).addClass('d-none');
                            $.ajax({
                                type: "get",
                                url: "{{ url('provider/load-chat-box/') }}" + "/" +
                                    sender_buyer_id,
                                success: function(response) {
                                    $(".chat-content").html(response)
                                    scrollToBottomFunc();
                                },
                                error: function(err) {}
                            })
                        } else {

                            let is_exist = false;
                            $('.buyer-list').each(function() {
                                let buyer_Id = $(this).data('buyer-id');
                                if (parseInt(buyer_Id) == parseInt(sender_buyer_id)) is_exist =
                                    true;
                            });

                            if (is_exist) {
                                let current_qty = $("#pending-" + sender_buyer_id).html();
                                let new_qty = parseInt(current_qty) + parseInt(1);
                                console.log(`new qty ${new_qty}`);
                                $("#pending-" + sender_buyer_id).html(new_qty);

                                $("#pending-" + sender_buyer_id).removeClass('d-none');

                            } else {
                                $.ajax({
                                    type: "get",
                                    url: "{{ url('provider/find-new-buyer/') }}" + "/" +
                                        sender_buyer_id,
                                    success: function(response) {
                                        let new_buyer = response.buyer;
                                        let default_avatar = response.default_avatar.image;

                                        let root_url = "{{ route('home') }}";
                                        let avatar = '';

                                        if (new_buyer.image) {
                                            avatar =
                                                `<img alt="image" class="mr-3 ml-3 rounded-circle" width="50" src="${root_url}/${new_buyer.image}">`
                                        } else {
                                            avatar =
                                                `<img alt="image" class="mr-3 ml-3 rounded-circle" width="50" src="${root_url}/${default_avatar}">`
                                        }

                                        let new_item = `
                                    <li id="customer-list-${sender_buyer_id}" class="media mt-2 buyer-list" onclick="loadChatBox(${sender_buyer_id},'${new_buyer.name}')" style="cursor: pointer" data-buyer-id="${sender_buyer_id}">
                                        ${avatar}
                                        <span class="pending" id="pending-${sender_buyer_id}">1</span>
                                        <div class="media-body mt-4">
                                            <div class="font-weight-bold">${new_buyer.name}</div>
                                        </div>
                                    </li>
                                `
                                        $("#my_buyer_list").prepend(new_item);

                                    },
                                    error: function(err) {}
                                })
                            }
                        }
                    });

            });
        })(jQuery);

        function loadChatBox(buyer_id, buyer_name) {
            $(".buyer_name").html(`<h4>${buyer_name}</h4>`)
            $(".send-message-button").attr('disabled', false);
            $("#customer_message").attr('readonly', false);
            $("#buyer_id").val(buyer_id);
            active_buyer_id = buyer_id;
            $("#pending-" + buyer_id).addClass('d-none');

            $.ajax({
                type: "get",
                url: "{{ url('provider/load-chat-box/') }}" + "/" + buyer_id,
                success: function(response) {
                    $(".chat-content").html(response)
                    scrollToBottomFunc();
                },
                error: function(err) {}
            })
        }

        function scrollToBottomFunc() {
            $('.chat-content').animate({
                scrollTop: $('.chat-content').get(0).scrollHeight
            }, 50);
        }
    </script>
@endsection
