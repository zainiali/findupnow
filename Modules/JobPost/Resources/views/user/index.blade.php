@extends($active_theme)
@section('title')
    <title>{{ __('Dashboard') }}</title>
@endsection
@section('meta')
    <meta name="description" content="{{ __('All Job Post') }}">
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
                            <h1>{{ __('All Job Post') }}</h1>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ __('All Job Post') }}</li>
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

                                <a href="{{ route('dashboard') }}#dashboard"><button class="nav-link"
                                        id="v-pills-jobpost-tab" type="button" aria-selected="false"><span><i
                                                class="fas fa-user"></i></span>
                                        {{ __('Dashboard') }} </button></a>

                                <a href="{{ route('jobpost.index') }}#jobpost"><button class="nav-link active"
                                        id="v-pills-jobpost-tab" type="button" aria-selected="false"><span><i
                                                class="fas fa-file-signature"></i></span> {{ __('Job Post') }}
                                    </button></a>

                                <a href="{{ route('dashboard') }}#order"><button class="nav-link" id="v-pills-jobpost-tab"
                                        type="button" aria-selected="false"><span><i
                                                class="fas fa-bags-shopping"></i></span> {{ __('Order') }}
                                    </button></a>

                                <a href="{{ route('dashboard') }}#reviews"><button class="nav-link"
                                        id="v-pills-jobpost-tab" type="button" aria-selected="false"><span><i
                                                class="fas fa-star"></i></span>
                                        {{ __('Reviews') }} </button></a>

                                <a href="{{ route('dashboard') }}#support"><button class="nav-link"
                                        id="v-pills-jobpost-tab" type="button" aria-selected="false"><span><i
                                                class="fas fa-user-headset"></i></span> {{ __('Support Ticket') }}
                                    </button></a>

                                <a href="{{ route('dashboard') }}#password"><button class="nav-link"
                                        id="v-pills-jobpost-tab" type="button" aria-selected="false"><span><i
                                                class="fas fa-user-lock"></i></span>
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

                                <div class="row py-4">
                                    <div class="col-md-12 d-flex align-items-center justify-content-between gap-3">
                                        <h3>{{ __('All Job Post') }}</h3>
                                        <a class="common_btn order_request_btn"
                                            href="{{ route('jobpost.create') }}">{{ __('Create New') }}</a>
                                    </div>
                                </div>

                                <div class="wsus_dashboard_order">
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <tbody>
                                                <tr class="t_header">
                                                    <th>{{ __('SN') }}</th>
                                                    <th>{{ __('Title') }}</th>
                                                    <th>{{ __('Price') }}</th>
                                                    <th>{{ __('Visibility') }}</th>
                                                    <th>{{ __('Applications') }}</th>
                                                    <th>{{ __('Job Status') }}</th>
                                                    <th>{{ __('Action') }}</th>
                                                </tr>
                                                @foreach ($job_posts as $index => $job_post)
                                                    <tr>
                                                        <td>
                                                            <h5>#{{ ++$index }}</h5>
                                                        </td>
                                                        <td>
                                                            <p>{{ html_decode($job_post->title) }} </p>
                                                        </td>
                                                        <td>
                                                            {{ currency($job_post->regular_price) }}
                                                        </td>

                                                        <td>
                                                            @if ($job_post->approved_by_admin == 'approved')
                                                                <span class="active">{{ __('Approved') }}</span>
                                                            @else
                                                                <span class="complete">{{ __('Waiting') }}</span>
                                                            @endif
                                                        </td>

                                                        <td>
                                                            <p class="inflanar-table__label">
                                                                <a
                                                                    href="{{ route('job-post-applicants', $job_post->id) }}">{{ __('Click here') }}
                                                                    ({{ $job_post->total_job_application }})
                                                                </a>
                                                            </p>
                                                        </td>

                                                        <td>
                                                            @if ($job_post->checkJobStatus($job_post->id) == 'approved')
                                                                <span class="active">{{ __('Hired') }}</span>
                                                            @elseif ($job_post->checkJobStatus($job_post->id) == 'pending')
                                                                <span class="complete">{{ __('Pending') }}</span>
                                                            @else
                                                                <span class="cancel">{{ __('Rejected') }}</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <a class="p-1 text-info"
                                                                href="{{ route('jobpost.edit', $job_post->id) }}"><i
                                                                    class="fa fa-edit" aria-hidden="true"></i></a>

                                                            <a class="p-1" data-bs-toggle="modal"
                                                                data-bs-target="#open_ticket{{ $job_post->id }}"
                                                                href="javascript:;"><i class="fa fa-trash"
                                                                    aria-hidden="true"></i></a>
                                                        </td>
                                                    </tr>

                                                    <!-- Support Ticket -->
                                                    <div class="modal fade" id="open_ticket{{ $job_post->id }}"
                                                        aria-labelledby="OpenTicketModalLabel" aria-hidden="true"
                                                        tabindex="-1">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="OpenTicketModalLabel">
                                                                        {{ __('Confirmation') }}</h5>
                                                                    <button class="btn-close" data-bs-dismiss="modal"
                                                                        type="button" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form
                                                                        action="{{ route('jobpost.destroy', $job_post->id) }}"
                                                                        method="post">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <div class="mb-5">
                                                                            <p>{{ __('Are you sure you want to delete this item?') }}
                                                                            </p>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-md-6">
                                                                                <button class="btn btn-danger"
                                                                                    type="submit">{{ __('Yes, Delete') }}</button>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <button class="btn btn-secondary"
                                                                                    data-bs-dismiss="modal"
                                                                                    type="button">{{ __('Cancel') }}</button>
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- End Support Ticket -->
                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div>

                                    {{ $job_posts->links('website.custom_pagination') }}
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
