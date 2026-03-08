@extends('admin.master_layout')
@section('title')
    <title>{{ __('Mobile Slider') }}</title>
@endsection
@section('admin-content')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('Mobile Slider') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a>
                    </div>
                    <div class="breadcrumb-item">{{ __('Mobile Slider') }}</div>
                </div>
            </div>

            <div class="section-body">
                <a class="btn btn-primary" href="{{ route('admin.mobile-slider.create') }}"><i class="fas fa-plus"></i>
                    {{ __('Add New') }}</a>
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive table-invoice">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>{{ __('SN') }}</th>
                                                <th>{{ __('Title one') }}</th>
                                                <th>{{ __('Image') }}</th>
                                                <th>{{ __('Action') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($sliders as $index => $slider)
                                                <tr>
                                                    <td>{{ $slider->serial }}</td>
                                                    <td>{{ $slider->title_one }}</td>
                                                    <td>
                                                        <img class="mobile_slider_image" src="{{ asset($slider->image) }}"
                                                            alt="">
                                                    </td>

                                                    <td>
                                                        <a class="btn btn-primary btn-sm"
                                                            href="{{ route('admin.mobile-slider.edit', $slider->id) }}"><i
                                                                class="fa fa-edit" aria-hidden="true"></i></a>

                                                        <a class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                            data-bs-target="#deleteModal" href="javascript:;"
                                                            onclick="deleteData({{ $slider->id }})"><i
                                                                class="fa fa-trash" aria-hidden="true"></i></a>
                                                    </td>

                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
    </div>

    <x-admin.delete-modal />

    <script>
        "use strict";

        function deleteData(id) {
            $("#deleteForm").attr("action", "{{ url('admin/mobile-slider') }}" + "/" + id)
        }
    </script>
@endsection
