@extends('admin.master_layout')
@section('title')
    <title>{{ __('Database clear') }}</title>
@endsection
@section('admin-content')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <x-admin.breadcrumb title="{{ __('Database clear') }}" :list="[
                __('Dashboard') => route('admin.dashboard'),
                __('Settings') => route('admin.settings'),
                __('Database clear') => '#',
            ]" />

            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="alert alert-warning alert-has-icon">
                                    <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
                                    <div class="alert-body">
                                        <div class="alert alert-warning" role="alert">
                                            <h4 class="alert-heading">⚠️ {{ __('Warning') }}:
                                                {{ __('This will permanently delete') }} <span
                                                    class="text-danger">({{ __('NO BACKUP FOUND') }})</span>:
                                            </h4>
                                            <ul>
                                                <li>{{ __('All appointment schedules and bookings') }}</li>
                                                <li>{{ __('All blog posts, comments, and categories') }}</li>
                                                <li>{{ __('All service categories and their translations') }}</li>
                                                <li>{{ __('All location data (cities, countries, states)') }}</li>
                                                <li>{{ __('All customer support tickets and messages') }}</li>
                                                <li>{{ __('All orders and purchase history') }}</li>
                                                <li>{{ __('All user accounts and profiles') }}</li>
                                                <li>{{ __('All service provider information') }}</li>
                                                <li>{{ __('All payment and subscription records') }}</li>
                                                <li>{{ __('All reviews and ratings') }}</li>
                                                <li>{{ __('All job postings and requests') }}</li>
                                                <li>{{ __('All contact form submissions') }}</li>
                                                <li>{{ __('All newsletter subscriptions') }}</li>
                                                <li>{{ __('All coupons and discount codes') }}</li>
                                                <li>{{ __('All KYC (Know Your Customer) information') }}</li>
                                                <li>{{ __('All service area configurations') }}</li>
                                                <li>{{ __('All custom page content') }}</li>
                                                <li>{{ __('All FAQs and their translations') }}</li>
                                            </ul>
                                            <hr>
                                            <p class="mb-0"><strong>{{ __('Important Note') }}:</strong>
                                                {{ __('This action will completely erase all data from the system and cannot be undone. Please make sure you have a backup before proceeding with this operation.') }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <x-admin.button data-bs-toggle="modal" data-bs-target="#clearDatabaseModal" variant="danger"
                                    text="{{ __('Clear Database') }}" />
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </div>

    <div class="modal fade" id="clearDatabaseModal" role="dialog" tabindex="-1">
        <div class="modal-dialog" role="document">
            <form class="modal-content" action="{{ route('admin.database-clear-success') }}" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('Clear Database Confirmation') }}</h5>
                    <button class="btn-close" data-bs-dismiss="modal" type="button"></button>
                </div>
                <div class="modal-body">
                    <p>{{ __('Are you really want to clear this database?') }}</p>
                    <x-admin.form-input id="password" name="password" type="password" label="{{ __('Password') }}"
                        required="true" />
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <x-admin.button data-bs-dismiss="modal" variant="danger" text="{{ __('Close') }}" />
                    <x-admin.button type="submit" text="{{ __('Yes, Clear') }}" />
                </div>
            </form>
        </div>
    </div>
@endsection
