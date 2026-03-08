@extends($active_theme)
@section('title')
    <title>{{ __('Dashboard') }}</title>
@endsection
@section('meta')
    <meta name="description" content="{{ __('Job Applications') }}">
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
                            <h1>{{ __('Job Applications') }}</h1>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ __('Job Applications') }}</li>
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
                                    src="{{ $user->image ? asset($user->image) : asset($setting->default_avatar) }}"
                                    alt="user">
                                <div class="text">
                                    <h2>{{ html_decode($user->name) }}</h2>
                                </div>
                            </div>
                            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist"
                                aria-orientation="vertical">

                                <a href="{{ route('dashboard') }}"><button class="nav-link" id="v-pills-jobpost-tab"
                                        type="button" aria-selected="false"><span><i class="fas fa-user"></i></span>
                                        {{ __('Dashboard') }} </button></a>

                                <a href="{{ route('jobpost.index') }}"><button class="nav-link active"
                                        id="v-pills-jobpost-tab" type="button" aria-selected="false"><span><i
                                                class="fas fa-file-signature"></i></span> {{ __('Job Post') }}
                                    </button></a>

                                <a href="{{ route('dashboard') }}"><button class="nav-link" id="v-pills-jobpost-tab"
                                        type="button" aria-selected="false"><span><i
                                                class="fas fa-bags-shopping"></i></span> {{ __('Order') }}
                                    </button></a>

                                <a href="{{ route('dashboard') }}"><button class="nav-link" id="v-pills-jobpost-tab"
                                        type="button" aria-selected="false"><span><i class="fas fa-star"></i></span>
                                        {{ __('Reviews') }} </button></a>

                                <a href="{{ route('dashboard') }}"><button class="nav-link" id="v-pills-jobpost-tab"
                                        type="button" aria-selected="false"><span><i
                                                class="fas fa-user-headset"></i></span> {{ __('Support Ticket') }}
                                    </button></a>

                                <a href="{{ route('dashboard') }}"><button class="nav-link" id="v-pills-jobpost-tab"
                                        type="button" aria-selected="false"><span><i class="fas fa-user-lock"></i></span>
                                        {{ __('Change Password') }}
                                    </button></a>

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
                            <div class="wsus_dashboard_body">
                                <div class="row py-1">
                                    <div class="col-md-12 d-flex flex-wrap align-items-center justify-content-between py-1">
                                        <h3>{{ __('All Job Applications') }}</h3>
                                        <a class="common_btn order_request_btn"
                                            href="{{ route('jobpost.index') }}">{{ __('Go Back') }}</a>
                                    </div>
                                </div>
                                <hr>
                                <div class="wsus_dashboard_order">
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <tbody>
                                                <tr class="t_header">
                                                    <th>{{ __('SN') }}</th>
                                                    <th>{{ __('Name') }}</th>
                                                    <th>{{ __('Phone') }}</th>
                                                    <th>{{ __('Email') }}</th>
                                                    <th>{{ __('Status') }}</th>
                                                    <th>{{ __('Action') }}</th>
                                                </tr>
                                                @foreach ($job_requests as $index => $job_request)
                                                    <tr>
                                                        <td>
                                                            <h5>#{{ ++$index }}</h5>
                                                        </td>
                                                        <td>
                                                            <p>{{ html_decode($job_request?->seller?->name) }} </p>
                                                        </td>
                                                        <td>
                                                            {{ html_decode($job_request?->seller?->phone) }}
                                                        </td>

                                                        <td>
                                                            {{ html_decode($job_request?->seller?->email) }}
                                                        </td>

                                                        <td>
                                                            @if ($job_request->status == 'approved')
                                                                <span class="active">{{ __('Hired') }}</span>
                                                            @elseif ($job_request->status == 'pending')
                                                                <span class="complete">{{ __('Pending') }}</span>
                                                            @else
                                                                <span class="complete">{{ __('Rejected') }}</span>
                                                            @endif
                                                        </td>

                                                        <td>
                                                            @if ($job_request->status == 'pending')
                                                                <a class="p-1 text-info " data-bs-toggle="modal"
                                                                    data-bs-target="#approvedOrder{{ $job_request->id }}"
                                                                    href="javascript:;"><i class="fas fa-check"></i></a>
                                                            @endif
                                                            <a class="p-1" data-bs-toggle="modal"
                                                                data-bs-target="#open_ticket{{ $job_request->id }}"
                                                                href="javascript:;">
                                                                <i class="fa fa-eye" aria-hidden="true"></i>
                                                            </a>
                                                        </td>
                                                    </tr>

                                                    <!-- Support Ticket -->

                                                    <div class="modal fade" id="approvedOrder{{ $job_request->id }}"
                                                        aria-labelledby="OpenTicketmodal" aria-hidden="true"
                                                        tabindex="-1">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="OpenTicketmodal">
                                                                        {{ __('Confirmation') }}</h5>
                                                                    <button class="btn-close" data-bs-dismiss="modal"
                                                                        type="button" aria-label="Close"></button>
                                                                </div>
                                                                <form
                                                                    action="{{ route('job-application-approval', $job_request->id) }}"
                                                                    method="post">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <div class="modal-body">
                                                                        <img class="img-fluid w-100"
                                                                            src="{{ asset('frontend/images/logout_img.webp') }}"
                                                                            alt="Logout">

                                                                        <p>{{ __('Are you sure you want to Approved Application') }}
                                                                            <b>{{ __('?') }}</b>
                                                                        </p>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button class="common_btn"
                                                                            type="submit">{{ __('Yes! Approved') }}</button>

                                                                        <button class="del_btn" data-bs-dismiss="modal"
                                                                            type="button">{{ __('cancel') }}</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Support TIcket  -->
                                                    <div class="inflanar-preview__modal modal fade"
                                                        id="open_ticket{{ $job_request->id }}"
                                                        aria-labelledby="OpenTicketmodal" aria-hidden="true"
                                                        tabindex="-1">
                                                        <div
                                                            class="modal-dialog modal-dialog-centered inflanar-preview__ticket">
                                                            <div class="modal-content">
                                                                <div class="modal-header inflanar__modal__header">
                                                                    <h4 class="modal-title inflanar-preview__modal-title"
                                                                        id="OpenTicketmodal">{{ __('Application') }}</h4>
                                                                    <button
                                                                        class="inflanar-preview__modal--close btn-close"
                                                                        data-bs-dismiss="modal" type="button"
                                                                        aria-label="Close"><i
                                                                            class="fas fa-remove"></i></button>
                                                                </div>
                                                                <div class="modal-body inflanar-modal__body">
                                                                    {{ __('Name') }} :
                                                                    {{ html_decode($job_request?->seller?->name) }}
                                                                    <hr>
                                                                    {{ __('Phone') }} :
                                                                    {{ html_decode($job_request?->seller?->phone) }}
                                                                    <hr>
                                                                    {{ __('Email') }} :
                                                                    {{ html_decode($job_request?->seller?->email) }}
                                                                    <hr>
                                                                    {{ __('Created At') }} :
                                                                    {{ $job_request->created_at->format('Y-m-d') }}
                                                                    <hr>
                                                                    {{ __('Comment') }} : {{ $job_request->description }}
                                                                    <hr>
                                                                    {{ __('Status') }} :
                                                                    @if ($job_request->status == 'approved')
                                                                        <span
                                                                            class="badge bg-success text-white">{{ __('Hired') }}</span>
                                                                    @elseif ($job_request->status == 'pending')
                                                                        <span
                                                                            class="badge bg-danger text-white">{{ __('Pending') }}</span>
                                                                    @else
                                                                        <span
                                                                            class="badge bg-danger text-white">{{ __('Rejected') }}</span>
                                                                    @endif
                                                                    <hr>
                                                                    {{ __('Resume') }} : <a
                                                                        href="{{ asset($job_request->resume) }}">Downlode
                                                                        Resume <i class="fas fa-file"></i></a>
                                                                    <hr>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- End Support TIcket  -->
                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div>

                                    {{ $job_requests->links('website.custom_pagination') }}
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

                        <p>{{ __('Are you sure you want to delete your account') }} <b>{{ __('Kingserv') }}</b>
                        </p>
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
@endsection
