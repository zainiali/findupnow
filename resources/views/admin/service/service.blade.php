@extends('admin.master_layout')
@section('title')
    <title>{{ $title }}</title>
@endsection
@section('admin-content')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ $title }}</h1>

            </div>

            <div class="section-body">
                <div class="card">
                    <div class="card-body">
                        <form action="">
                            <div class="row">
                                <div class="col-md-10">
                                    <label class="form-label" for="provider">{{ __('Provider') }}</label>
                                    <select class="form-select select2" id="provider" name="provider">
                                        <option value="">{{ __('Select') }}</option>
                                        @if (request()->has('provider'))
                                            @foreach ($providers as $provider)
                                                <option value="{{ $provider->id }}"
                                                    {{ request()->get('provider') == $provider->id ? 'selected' : '' }}>
                                                    {{ $provider->name }}</option>
                                            @endforeach
                                        @else
                                            @foreach ($providers as $provider)
                                                <option value="{{ $provider->id }}">{{ $provider->name }}</option>
                                            @endforeach
                                        @endif

                                    </select>
                                </div>

                                <div class="col-md-2">
                                    <button class="btn btn-primary plus_btn">{{ __('Search') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="section-body">
                <a class="btn btn-primary text-right" href="{{ route('admin.service.create') }}">
                    <i class="fas fa-plus">
                    </i>
                    {{ __('Add New') }}
                </a>
                <div class="row mt-4">
                    @if ($services->count() > 0)
                        @foreach ($services as $service)
                            <div class="col-12">
                                <div class="card service_card">
                                    <div class="card-body d-flex flex-wrap justify-content-between align-items-center">
                                        <img class="service_image" src="{{ asset($service->image) }}" alt="">
                                        <div class="service_detail">
                                            <h4>{{ $service->name }}</h4>
                                            <h6>{{ __('Price') }} :
                                                {{ currency($service->price) }}
                                            </h6>
                                            <p>{{ __('Category') }} : {{ $service->category->name }}</p>
                                            @if ($service->make_featured == 1 || $service->make_popular == 1)
                                                <p>{{ __('Highlight') }} :

                                                    @if ($service->make_featured == 1)
                                                        {{ __('Featured') }}
                                                    @endif
                                                    @if ($service->make_featured == 1 && $service->make_popular == 1)
                                                        ,
                                                    @endif
                                                    @if ($service->make_popular == 1)
                                                        {{ __('Popular') }}
                                                    @endif
                                                </p>
                                            @endif
                                            <p>{{ __('Status') }} :

                                                @if ($service->is_banned == 1)
                                                    <span class="badge badge-danger">{{ __('Banned') }}</span>
                                                @elseif ($service->approve_by_admin == 0)
                                                    <span
                                                        class="badge badge-danger">{{ __('Awaiting for approval') }}</span>
                                                @else
                                                    @if ($service->status == 1)
                                                        <span class="badge badge-success">{{ __('Active') }}</span>
                                                    @else
                                                        <span class="badge badge-danger">{{ __('Inactive') }}</span>
                                                    @endif
                                                @endif

                                            </p>

                                            <p>{{ __('Provider') }}: 
                                                @if ($service->provider)
                                                    <a href="{{ route('admin.provider-show', $service->provider_id) }}">{{ $service->provider->name }}</a>
                                                @else
                                                    <span class="text-danger">{{ __('Provider Not Found') }}</span>
                                                @endif
                                            </p>
                                            <a class="btn btn-primary btn-sm"
                                                href="{{ route('admin.service.edit', $service->id) }}"><i
                                                    class="fas fa-edit"></i> {{ __('Edit') }}</a>

                                            @if ($service->totalOrder == 0)
                                                <a class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#deleteModal" href="javascript:;"
                                                    onclick="deleteData({{ $service->id }})"><i class="fas fa-trash"></i>
                                                    {{ __('Remove') }}</a>
                                            @else
                                                <a class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#canNotDeleteModal" href="javascript:;" disabled><i
                                                        class="fa fa-trash" aria-hidden="true"></i> {{ __('Remove') }}</a>
                                            @endif

                                            @if ($service->status == 1)
                                                <a class="btn btn-success btn-sm"
                                                    href="{{ route('service', $service->slug) }}" target="_blank"><i
                                                        class="fas fa-eye"></i> {{ __('View') }}</a>
                                            @else
                                                <button class="btn btn-warning btn-sm disabled-cursor " disabled>
                                                    <i class="fas fa-eye-slash"></i> {{ __('Inactive') }}
                                                </button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        {{-- Pagination removed - showing all services --}}
                    @else
                        <div class="col-12 text-center text-danger">
                            <h4>{{ __('Service not found!') }}</h4>
                        </div>
                    @endif
                </div>
        </section>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="canNotDeleteModal" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true"
        tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    {{ __('You can not delete this service. Because there are one or more order has been created in this product.') }}
                </div>

                <div class="modal-footer">
                    <button class="btn btn-danger" data-dismiss="modal" type="button">{{ __('Close') }}</button>
                </div>
            </div>
        </div>
    </div>

    <x-admin.delete-modal />
    <script>
        "use strict";

        function deleteData(id) {
            $("#deleteForm").attr("action", "{{ url('admin/service/') }}" + "/" + id)
        }
    </script>
@endsection
