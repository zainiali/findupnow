@extends($active_theme)
@section('title')
    <title>{{ __('Dashboard') }}</title>
@endsection
@section('meta')
    <meta name="description" content="{{ __('Dashboard') }}">
@endsection

@section('frontend-content')
    <!--=========================
                                                                                                                                                                                                                                                                                                                                                                                                                                                BREADCRUMB START
                                                                                                                                                                                                                                                                                                                                                                                                                                            ==========================-->
    <div class="wsus__breadcrumb" style="background: url({{ asset($breadcrumb->image) }});">
        <div class="wsus__breadcrumb_overlay pt_90 xs_pt_60 pb_95 xs_pb_65">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <nav aria-label="breadcrumb">
                            <h1>{{ __('Dashboard') }}</h1>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ __('Dashboard') }}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--=========================
                                                                                                                                                                                                                                                                                                                                                                                                                                                BREADCRUMB END
                                                                                                                                                                                                                                                                                                                                                                                                                                            ==========================-->

    <!--=========================
                                                                                                                                                                                                                                                                                                                                                                                                                                                DASHBOARD START
                                                                                                                                                                                                                                                                                                                                                                                                                                            ==========================-->
    <section class="wsus__dashboard mt_90 xs_mt_60 mb_100 xs_mb_70">
        <div class="container">
            <div class="wsus__dashboard_area">
                <div class="row">
                    <div class="col-xl-3 col-lg-4">
                        <div class="wsus__dashboard_menu">
                            <div class="dasboard_header d-flex flex-wrap align-items-center">
                                <img class="img-fluid w-100 user_avatar"
                                    src="{{ $user->image ? asset($user->image) : asset($default_avatar->image) }}"
                                    alt="user">
                                <div class="text">
                                    <h2>{{ html_decode($user->name) }}</h2>
                                </div>
                            </div>
                            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist"
                                aria-orientation="vertical">
                                <button class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill"
                                    data-bs-target="#v-pills-home" type="button" role="tab"
                                    aria-controls="v-pills-home" aria-selected="true"><span><i
                                            class="fas fa-user"></i></span> {{ __('Dashboard') }}</button>

                                <a href="{{ route('jobpost.index') }}"><button class="nav-link" id="v-pills-jobpost-tab"
                                        type="button" aria-selected="false"><span><i
                                                class="fas fa-file-signature"></i></span> {{ __('Job Post') }}
                                    </button></a>

                                <button class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill"
                                    data-bs-target="#v-pills-profile" type="button" role="tab"
                                    aria-controls="v-pills-profile" aria-selected="false"><span><i
                                            class="fas fa-bags-shopping"></i></span> {{ __('Order') }}</button>
                                <button class="nav-link" id="v-pills-messages-tab" data-bs-toggle="pill"
                                    data-bs-target="#v-pills-messages" type="button" role="tab"
                                    aria-controls="v-pills-messages" aria-selected="false"><span><i
                                            class="fas fa-star"></i></span> {{ __('Reviews') }}</button>

                                <button class="nav-link support_ticket_tab" id="v-pills-messages-tab2" data-bs-toggle="pill"
                                    data-bs-target="#v-pills-messages2" type="button" role="tab"
                                    aria-controls="v-pills-messages2" aria-selected="false"><span><i
                                            class="fas fa-user-headset"></i></span> {{ __('Support Ticket') }}</button>

                                <button class="nav-link" id="v-pills-settings-tab" data-bs-toggle="pill"
                                    data-bs-target="#v-pills-settings" type="button" role="tab"
                                    aria-controls="v-pills-settings" aria-selected="false"><span><i
                                            class="fas fa-user-lock"></i></span> {{ __('Change Password') }} </button>

                                <button class="nav-link" data-bs-toggle="modal" data-bs-target="#accountDelete"
                                    type="button"><span> <i class="fas fa-trash"></i> </span>
                                    {{ __('Delete Account') }}</button>

                                <button class="nav-link" data-bs-toggle="modal" data-bs-target="#exampleModal"
                                    type="button"><span> <i class="fas fa-sign-out-alt"></i> </span>
                                    {{ __('Logout') }}</button>

                            </div>
                        </div>
                    </div>
                    <div class="col-xl-9 col-lg-8">
                        <div class="wsus__dashboard_content">
                            <div class="tab-content" id="v-pills-tabContent">
                                <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel"
                                    aria-labelledby="v-pills-home-tab">

                                    <div class="wsus_dashboard_body">
                                        <p>{{ __('Hello') }}, {{ html_decode($user->name) }}</p>
                                        <h3>{{ __('Welcome to your Profile') }}</h3>
                                        <div class="row">
                                            <div class="col-lg-4 col-md-6">
                                                <div class="wsus__dashboard_info"
                                                    style="background: url({{ asset('frontend/images/dash_ifo_bg.webp') }});">
                                                    <span><i class="fas fa-bags-shopping"></i></span>
                                                    <h5>{{ __('Order Active') }}</h5>
                                                    <h2>{{ $active_order }}</h2>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6">
                                                <div class="wsus__dashboard_info"
                                                    style="background: url({{ asset('frontend/images/dash_ifo_bg.webp') }});">
                                                    <span><i class="fas fa-box-check"></i></span>
                                                    <h5>{{ __('Order Completed') }}</h5>
                                                    <h2>{{ $complete_order }}</h2>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6">
                                                <div class="wsus__dashboard_info"
                                                    style="background: url({{ asset('frontend/images/dash_ifo_bg.webp') }});">
                                                    <span><i class="far fa-clipboard-list-check"></i></span>
                                                    <h5>{{ __('Total Order') }}</h5>
                                                    <h2>{{ $total_order }}</h2>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="wsus_dash_personal_info">
                                            <div class="nav nav-pills d-flex flex-wrap justify-content-between align-items-center"
                                                id="pills-tab" role="tablist">
                                                <h4>{{ __('Personal Information') }}</h4>
                                                <button class="nav-link" id="toggleProfileSection" type="button"
                                                    role="tab">{{ __('edit') }}</button>
                                            </div>
                                            <div class="tab-content">
                                                <div id="profile_section">
                                                    <p><span>{{ __('Name') }}:</span> {{ html_decode($user->name) }}
                                                    </p>
                                                    <p><span>{{ __('Email') }}:</span> {{ html_decode($user->email) }}
                                                    </p>
                                                    <p><span>{{ __('Phone') }}:</span> {{ html_decode($user->phone) }}
                                                    </p>
                                                    <p><span>{{ __('Address') }}:</span> {{ html_decode($user->address) }}
                                                    </p>
                                                </div>
                                                <div class="d-none" id="profile_edit_section">
                                                    <div class="wsus__review_input">
                                                        <form id="editProfileFormId">
                                                            @csrf
                                                            <div class="row">
                                                                <div class="col-xl-6">
                                                                    <fieldset>
                                                                        <legend>{{ __('Name') }}*</legend>
                                                                        <input name="name" type="text"
                                                                            value="{{ html_decode($user->name) }}">
                                                                    </fieldset>
                                                                </div>
                                                                <div class="col-xl-6">
                                                                    <fieldset>
                                                                        <legend>{{ __('email') }}*</legend>
                                                                        <input name="email" type="email"
                                                                            value="{{ html_decode($user->email) }}"
                                                                            readonly>
                                                                    </fieldset>
                                                                </div>
                                                                <div class="col-xl-6">
                                                                    <fieldset>
                                                                        <legend>{{ __('phone') }}*</legend>
                                                                        <input name="phone" type="text"
                                                                            value="{{ html_decode($user->phone) }}"
                                                                            placeholder="{{ __('e.g. +92345689008876') }}">
                                                                        <small class="d-block text-muted mt-1">{{ __('Enter + then your country code and number with no spaces (e.g. +92345689008876).') }}</small>
                                                                    </fieldset>
                                                                </div>
                                                                <div class="col-xl-6">
                                                                    <fieldset>
                                                                        <legend>{{ __('Image') }}</legend>
                                                                        <input name="image" type="file">
                                                                    </fieldset>
                                                                </div>

                                                                <div class="col-xl-12">
                                                                    <fieldset>
                                                                        <legend>{{ __('address') }}*</legend>
                                                                        <input name="address" type="text"
                                                                            value="{{ html_decode($user->address) }}">
                                                                    </fieldset>
                                                                    <button class="common_btn mt_20" type="submit">
                                                                        {{ __('Save Profile') }}</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="v-pills-profile" role="tabpanel"
                                    aria-labelledby="v-pills-profile-tab">
                                    <div class="wsus_dashboard_body">
                                        <div class="wsus_dashboard_order">
                                            <div class="table-responsive">
                                                <table class="table table-striped">
                                                    <tbody>
                                                        <tr class="t_header">
                                                            <th>{{ __('Order') }}</th>
                                                            <th>{{ __('Date') }}</th>
                                                            <th>{{ __('Status') }}</th>
                                                            <th>{{ __('Amount') }}</th>
                                                            <th>{{ __('Action') }}</th>
                                                        </tr>
                                                        @foreach ($orders as $index => $order)
                                                            <tr>
                                                                <td>
                                                                    <h5>#{{ $order->order_id }}</h5>
                                                                </td>
                                                                <td>
                                                                    <p>{{ $order->booking_date ? date('M d, Y', strtotime($order->booking_date)) : '' }}
                                                                    </p>
                                                                </td>
                                                                <td>

                                                                    @if ($order->order_status == 'approved_by_provider')
                                                                        <span class="active">{{ __('Active') }}</span>
                                                                    @elseif ($order->order_status == 'complete')
                                                                        <span
                                                                            class="complete">{{ __('completed') }}</span>
                                                                    @elseif ($order->order_status == 'order_decliened_by_provider' || $order->order_status == 'order_decliened_by_client')
                                                                        <span class="cancel">{{ __('Declined') }}</span>
                                                                    @elseif ($order->order_status == 'awaiting_for_provider_approval')
                                                                        <span class="cancel">{{ __('Pending') }}</span>
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    <h5>
                                                                        {{ currency($order->total_amount) }}
                                                                    </h5>
                                                                </td>
                                                                <td>
                                                                    <a class="view_invoice"
                                                                        id="order-{{ $order->id }}"
                                                                        data-payment-status="{{ $order->payment_status }}"
                                                                        href="javascript:;"
                                                                        onclick="loadInvoice({{ $order->order_id }})">{{ __('View Details') }}</a>

                                                                    @if ($order->payment_status == 'pending')
                                                                        <a class="m-1 p-1 border-start"
                                                                            href="{{ route('user.sub.complete.payment', $order->id) }}">{{ __('Pay Now') }}</a>
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                        @endforeach

                                                    </tbody>
                                                </table>
                                            </div>

                                            <div class="row">
                                                {{ $orders->links('website.custom_pagination') }}
                                            </div>
                                        </div>

                                        <div class="wsus__invoice">
                                            <div class="d-flex justify-content-between align-items-center gap-3">
                                                <a class="go_back"><i class="fas fa-long-arrow-alt-left"></i> go back</a>
                                                @foreach ($orders as $index => $order)
                                                    @if ($order->payment_status == 'pending')
                                                        <a class="m-1 p-1 btn btn-warning pending-payment d-none"
                                                            id="pending-payment-{{ $order->id }}"
                                                            href="{{ route('user.sub.complete.payment', $order->id) }}"><i
                                                                class="fas fa-sack-dollar"></i>
                                                            {{ __('Complete Payment') }}</a>
                                                    @endif
                                                @endforeach
                                            </div>

                                            <div id="invoice_box">

                                            </div>

                                        </div>

                                    </div>
                                </div>

                                <div class="tab-pane fade" id="v-pills-messages" role="tabpanel"
                                    aria-labelledby="v-pills-messages-tab">
                                    <div class="wsus_dashboard_body dashboard_review">
                                        <h3>{{ __('review') }}</h3>

                                        @foreach ($reviews as $index => $review)
                                            <div class="wsus__single_review">
                                                <div class="wsus__single_review_top">
                                                    <img class="img-fluid" src="{{ asset($review->service->image) }}"
                                                        alt="review">
                                                    <div class="text">
                                                        <h3>
                                                            <a
                                                                href="{{ route('service', $review->service->slug) }}">{{ $review->service->name }}</a>
                                                            <span>
                                                                @for ($i = 1; $i <= 5; $i++)
                                                                    @if ($i <= $review->rating)
                                                                        <i class="fas fa-star"></i>
                                                                    @else
                                                                        <i class="far fa-star"></i>
                                                                    @endif
                                                                @endfor
                                                            </span>
                                                        </h3>
                                                        <p>{{ date('d M Y', strtotime($review->created_at)) }}</p>
                                                    </div>
                                                </div>
                                                <p class="review_text">{{ $review->review }}</p>
                                            </div>
                                        @endforeach

                                        <div class="row">
                                            {{ $reviews->links('website.custom_pagination') }}
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade " id="v-pills-messages2" role="tabpanel"
                                    aria-labelledby="v-pills-messages-tab2">
                                    <div class="wsus_dashboard_body">
                                        <div class="support_ticket">
                                            <div class="wsus__support_ticket_top">
                                                <h3>{{ __('Support Ticket') }}</h3>
                                                <div class="right">
                                                    <a class="common_btn order_request_btn" data-bs-toggle="modal"
                                                        data-bs-target="#exampleModal_ticket">{{ __('Open New Ticket') }}</a>

                                                </div>
                                            </div>

                                            <div class="wsus__ticket_item">
                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <tbody>
                                                            <tr>
                                                                <th class="sn">{{ __('SN') }}</th>
                                                                <th class="info">{{ __('Ticket Info') }}</th>
                                                                <th class="from">{{ __('Unread Message') }}</th>
                                                                <th class="status">{{ __('Status') }}</th>
                                                                <th class="action">{{ __('Action') }}</th>
                                                            </tr>
                                                            @foreach ($tickets as $index => $ticket)
                                                                <tr>
                                                                    <td class="sn">
                                                                        <p>{{ ++$index }}</p>
                                                                    </td>

                                                                    <td class="info">
                                                                        <p>{{ __('Subject') }}:
                                                                            {{ html_decode($ticket->subject) }}</p>
                                                                        <p>{{ __('Ticket Id') }}: {{ $ticket->ticket_id }}
                                                                        </p>
                                                                        <p>{{ __('Booking Id') }}: <a
                                                                                href="javascript:;">{{ $ticket->order->order_id ?? '' }}</a>
                                                                        </p>
                                                                        <p>{{ __('Created') }}:
                                                                            {{ $ticket->created_at->format('h:m A, d-M-Y') }}
                                                                        </p>
                                                                    </td>

                                                                    <td class="from">
                                                                        <p><span
                                                                                class="badge bg-danger text-light">{{ $ticket->unSeenUserMessage }}</span>
                                                                        </p>
                                                                    </td>

                                                                    <td class="status">

                                                                        @if ($ticket->status == 'pending')
                                                                            <span
                                                                                class="closed">{{ __('Pending') }}</span>
                                                                        @elseif ($ticket->status == 'in_progress')
                                                                            <span
                                                                                class="active">{{ __('In Progress') }}</span>
                                                                        @elseif ($ticket->status == 'closed')
                                                                            <span
                                                                                class="closed">{{ __('Closed') }}</span>
                                                                        @endif
                                                                    </td>
                                                                    <td class="action">
                                                                        <a class="ticket_invoice_view"
                                                                            onclick="showTicket({{ $ticket->ticket_id }})"><i
                                                                                class="far fa-eye"></i></a>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>

                                            {{ $tickets->links('website.ticket_pagination') }}

                                        </div>

                                        {{-- view ticket box --}}
                                        <div class="wsus__ticket_list_view">

                                        </div>
                                        {{-- end ticket box --}}

                                        {{-- new ticket modal --}}
                                        <div class="wsus__ticket_modal">
                                            <div class="modal fade" id="exampleModal_ticket"
                                                aria-labelledby="exampleModal_ticket" aria-hidden="true" tabindex="-1">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header pb-0">
                                                            <h5 class="modal-title" id="exampleModalLabel0">
                                                                {{ __('Create a new ticket') }}
                                                            </h5>
                                                            <button class="btn-close" data-bs-dismiss="modal"
                                                                type="button" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="wsus__review_input p-0 border-0">
                                                                <form action="{{ route('ticket-request') }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    <div class="row">
                                                                        <div class="col-xl-12">
                                                                            <fieldset>
                                                                                <legend>{{ __('select order') }}*</legend>
                                                                                <select name="order_id">
                                                                                    <option value="">
                                                                                        {{ __('Select') }}</option>
                                                                                    @foreach ($orders as $order)
                                                                                        <option
                                                                                            value="{{ $order->id }}">
                                                                                            {{ $order->order_id }}
                                                                                        </option>
                                                                                    @endforeach

                                                                                </select>
                                                                            </fieldset>
                                                                        </div>
                                                                        <div class="col-xl-12">
                                                                            <fieldset>
                                                                                <legend>{{ __('subject') }}*</legend>
                                                                                <input name="subject" type="text">
                                                                            </fieldset>
                                                                        </div>
                                                                        <div class="col-xl-12">
                                                                            <fieldset>
                                                                                <legend>{{ __('message') }}*</legend>
                                                                                <textarea name="message" rows="5"></textarea>
                                                                            </fieldset>
                                                                            <button class="common_btn w-100 mt_20"
                                                                                type="submit">{{ __('Submit') }}</button>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- end modal --}}

                                    </div>
                                </div>

                                <div class="tab-pane fade" id="v-pills-settings" role="tabpanel"
                                    aria-labelledby="v-pills-settings-tab">
                                    <div class="wsus_dashboard_body">
                                        <div class="wsus__review_input">
                                            <h3>{{ __('change password') }}</h3>
                                            <form id="changePasswordFormId">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <fieldset>
                                                            <legend>{{ __('Current Password') }}*</legend>
                                                            <input name="current_password" type="password">
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <fieldset>
                                                            <legend>{{ __('New Password') }}*</legend>
                                                            <input name="password" type="password">
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <fieldset>
                                                            <legend>{{ __('Confirm New Password') }}*</legend>
                                                            <input name="password_confirmation" type="password">
                                                        </fieldset>
                                                        <button class="common_btn mt_20"
                                                            type="submit">{{ __('Update') }}</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="exampleModal" aria-labelledby="exampleModalLabel" aria-hidden="true"
            tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">{{ __('Confirm') }}</h5>
                        <button class="btn-close" data-bs-dismiss="modal" type="button" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <img class="img-fluid w-100" src="{{ asset('frontend/images/logout_img.webp') }}"
                            alt="Logout">
                        <p>{{ __('Are you sure you want to Logout') }}</p>
                    </div>
                    <div class="modal-footer">
                        <a class="common_btn" href="{{ route('user.logout') }}">{{ __('Yes! Logout') }}</a>

                        <button class="del_btn" data-bs-dismiss="modal" type="button">{{ __('cancel') }}</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="accountDelete" aria-labelledby="accountDelete" aria-hidden="true" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-body">

                        <p>{{ __('Are you sure you want to delete your account') }} <b>{{ __('Kingserv') }}</b></p>
                    </div>
                    <div class="modal-footer">
                        <a class="common_btn" href="{{ route('user.delete-account') }}">{{ __('Yes, Delete') }}</a>

                        <button class="del_btn" data-bs-dismiss="modal" type="button">{{ __('cancel') }}</button>

                    </div>
                </div>
            </div>
        </div>

    </section>
    <!--=========================
                                                                                                                                                                                                                                                                                                                                                                                                                                                DASHBOARD END
                                                                                                                                                                                                                                                                                                                                                                                                                                            ==========================-->

    <script>
        (function($) {
            "use strict";
            $(document).ready(function() {
                $("#toggleProfileSection").on("click", function() {
                    if ($(this).hasClass('active')) {
                        $(this).removeClass('active')
                        $("#profile_section").removeClass('d-none')
                        $("#profile_edit_section").addClass('d-none')
                    } else {
                        $(this).addClass('active')
                        $("#profile_section").addClass('d-none')
                        $("#profile_edit_section").removeClass('d-none')
                    }
                })

                $("#editProfileFormId").on('submit', function(e) {
                    e.preventDefault();

                    var isDemo = "{{ env('APP_MODE') }}"
                    if (isDemo == 'DEMO') {
                        toastr.error('This Is Demo Version. You Can Not Change Anything');
                        return;
                    }

                    $.ajax({
                        url: "{{ route('update-profile') }}",
                        type: "post",
                        data: new FormData(this),
                        dataType: 'JSON',
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: function(response) {
                            if (response.status == 'success') {
                                toastr.success(response.message)
                                let image_url = "{{ route('home') }}";
                                image_url = image_url + "/" + response.user.image;
                                $('.user_avatar').attr("src", image_url);
                                let user = response.user;
                                let profile_section = `
                                <p><span>{{ __('Name') }}:</span> ${user.name}</p>
                                <p><span>{{ __('Email') }}:</span> ${user.email}</p>
                                <p><span>{{ __('Phone') }}:</span> ${user.phone}</p>
                                <p><span>{{ __('Address') }}:</span> ${user.address}</p>
                            `;
                                $("#profile_section").html(profile_section);
                                $("#toggleProfileSection").removeClass('active')
                                $("#profile_section").removeClass('d-none')
                                $("#profile_edit_section").addClass('d-none')
                            }
                        },
                        error: function(response) {
                            if (response.responseJSON.errors.email) toastr.error(response
                                .responseJSON.errors.email[0])
                            if (response.responseJSON.errors.name) toastr.error(response
                                .responseJSON.errors.name[0])
                            if (response.responseJSON.errors.phone) toastr.error(response
                                .responseJSON.errors.phone[0])
                            if (response.responseJSON.errors.address) toastr.error(response
                                .responseJSON.errors.address[0])

                        }
                    });

                })

                $("#changePasswordFormId").on("submit", function(e) {
                    e.preventDefault();

                    var isDemo = "{{ env('APP_MODE') }}"
                    if (isDemo == 'DEMO') {
                        toastr.error('This Is Demo Version. You Can Not Change Anything');
                        return;
                    }

                    $.ajax({
                        url: "{{ route('update-password') }}",
                        type: "post",
                        data: $('#changePasswordFormId').serialize(),
                        success: function(response) {
                            if (response.status == 'success') {
                                toastr.success(response.message)
                                $("#changePasswordFormId").trigger("reset");

                                setTimeout(() => {
                                    window.location.href =
                                        "{{ route('user.logout') }}";
                                }, 2000);
                            }
                        },
                        error: function(response) {
                            if (response.status == 403) {
                                toastr.error(response.responseJSON.message)
                            } else {
                                if (response.responseJSON.errors.current_password) toastr
                                    .error(response.responseJSON.errors.current_password[0])
                                if (response.responseJSON.errors.password) toastr.error(
                                    response.responseJSON.errors.password[0])
                            }
                        }
                    });
                })
            });
        })(jQuery);

        function showTicket(id) {
            $.ajax({
                url: "{{ url('/show-ticket') }}" + "/" + id,
                type: "get",
                success: function(response) {
                    $(".wsus__ticket_list_view").html(response);
                },
                error: function(response) {}
            });
        }

        function loadInvoice(id) {
            $.ajax({
                url: "{{ url('/get-invoice') }}" + "/" + id,
                type: "get",
                success: function(response) {
                    $("#invoice_box").html(response);
                },
                error: function(response) {}
            });
        }
    </script>

    <script>
        "use strict";

        document.addEventListener('DOMContentLoaded', function() {
            const fragment = window.location.hash;

            const fragmentToButtonMap = {
                '#dashboard': 'v-pills-home-tab',
                '#jobpost': 'v-pills-jobpost-tab',
                '#order': 'v-pills-profile-tab',
                '#reviews': 'v-pills-messages-tab',
                '#support': 'v-pills-messages-tab2',
                '#password': 'v-pills-settings-tab',
                '#delete': 'accountDelete',
                '#logout': 'exampleModal'
            };

            // Step 3: Find the corresponding button/modal based on the fragment
            const targetId = fragmentToButtonMap[fragment];
            if (targetId) {
                const targetElement = document.getElementById(targetId);

                if (targetElement) {
                    if (targetElement.tagName === 'BUTTON') {
                        targetElement.click();
                    } else if (targetElement.classList.contains('modal')) {
                        const modal = new bootstrap.Modal(targetElement);
                        modal.show();
                    }
                }
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
            const urlParams = new URLSearchParams(window.location.search);
            const orderId = urlParams.get('id');

            if (orderId) {
                const targetId = `order-${orderId}`;

                const targetLink = document.getElementById(targetId);

                let paymentStatus = targetLink.getAttribute("data-payment-status");

                if (paymentStatus === "pending") {
                    document.querySelectorAll(".pending-payment").forEach(function(btn) {
                        btn.classList.add("d-none");
                    });

                    let paymentButton = document.getElementById("pending-payment-" + orderId);

                    if (paymentButton) {
                        paymentButton.classList.remove("d-none");
                    }
                }

                if (targetLink && typeof targetLink.onclick === 'function') {
                    document.getElementById('v-pills-profile-tab').click();
                    $(".wsus_dashboard_order").fadeOut();
                    $(".wsus__invoice").fadeIn();
                    document.getElementById(targetId).click();
                }
            }
        });

        $(document).ready(function() {
            "use strict";

            $(".view_invoice").on("click", function() {
                let orderId = $(this).attr("id").replace("order-", "");
                let paymentStatus = $(this).data("payment-status");

                $(".pending-payment").addClass("d-none");

                if (paymentStatus === "pending") {
                    $("#pending-payment-" + orderId).removeClass("d-none");
                }
            });
        });
    </script>
@endsection
