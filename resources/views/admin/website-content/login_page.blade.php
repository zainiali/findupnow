@extends('admin.master_layout')
@section('title')
    <title>{{ __('Login page') }}</title>
@endsection
@section('admin-content')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('Login page') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a>
                    </div>
                    <div class="breadcrumb-item">{{ __('Login page') }}</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row mt-4">
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('admin.update-login-page') }}" enctype="multipart/form-data"
                                    method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <label for="form-label">{{ __('Existing Image') }}</label>
                                        <div>
                                            <img class="default-avatar img-thumbnail" src="{{ asset($login_page->image) }}"
                                                alt="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="image">{{ __('New Avatar') }}</label>
                                        <input class="form-control" id="image" name="image" type="file" required>
                                    </div>
                                    <button class="btn btn-primary" type="submit">{{ __('Update') }}</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
    </div>
@endsection
