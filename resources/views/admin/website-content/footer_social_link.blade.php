@extends('admin.master_layout')
@section('title')
    <title>{{ __('Social Link') }}</title>
@endsection
@section('admin-content')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('Social Link') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a
                            href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></div>
                    <div class="breadcrumb-item">{{ __('Social Link') }}</div>
                </div>
            </div>

            <div class="section-body">
                <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createIcon" href="javascript:;"><i
                        class="fas fa-plus"></i> {{ __('Add New') }}</a>
                <div class="row mt-4">
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive table-invoice">
                                    <table class="table table-striped" id="dataTable">
                                        <thead>
                                            <tr>
                                                <th>{{ __('SN') }}</th>
                                                <th>{{ __('Link') }}</th>
                                                <th>{{ __('Icon') }}</th>
                                                <th>{{ __('Action') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($links as $index => $link)
                                                <tr>
                                                    <td>{{ ++$index }}</td>
                                                    <td>{{ $link->link }}</td>
                                                    <td> <i class="{{ $link->icon }}"></i></td>
                                                    <td>
                                                        <a class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                                            data-bs-target="#editIcon-{{ $link->id }}"
                                                            href="javascript:;"><i class="fa fa-edit"
                                                                aria-hidden="true"></i></a>

                                                        <a class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                            data-bs-target="#deleteModal" href="javascript:;"
                                                            onclick="deleteData({{ $link->id }})"><i
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

    <!--Create Modal -->
    <div class="modal fade" id="createIcon" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('Create Social Link') }}</h5>
                    <button class="btn btn-danger" data-dismiss="modal" type="button" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <form action="{{ route('admin.social-link.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="">{{ __('Icon') }}</label>
                                <input class="form-control custom-icon-picker" name="icon" type="text">
                            </div>
                            <div class="form-group">
                                <label for="">{{ __('Link') }}</label>
                                <input class="form-control" name="link" type="text">
                            </div>
                            <div class="d-flex justify-content-between">
                                <button class="btn btn-danger" data-dismiss="modal"
                                    type="button">{{ __('Close') }}</button>
                                <button class="btn btn-primary" type="submit">{{ __('Save') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- edit modal --}}
    @foreach ($links as $link)
        <div class="modal fade" id="editIcon-{{ $link->id }}" role="dialog" aria-labelledby="modelTitleId"
            aria-hidden="true" tabindex="-1">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ __('Edit Social Link') }}</h5>
                        <button class="btn btn-danger" data-dismiss="modal" type="button" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <form action="{{ route('admin.social-link.update', $link->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="">{{ __('Icon') }}</label>
                                    <input class="form-control custom-icon-picker" name="icon" type="text"
                                        value="{{ $link->icon }}">
                                </div>
                                <div class="form-group">
                                    <label for="">{{ __('Link') }}</label>
                                    <input class="form-control" name="link" type="text"
                                        value="{{ $link->link }}">
                                </div>
                                <div class="d-flex justify-content-between">
                                    <button class="btn btn-danger" data-dismiss="modal"
                                        type="button">{{ __('Close') }}</button>
                                    <button class="btn btn-primary" type="submit">{{ __('Update') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <x-admin.delete-modal />

    <script>
        "use strict";

        function deleteData(id) {
            $("#deleteForm").attr("action", '{{ url('admin/social-link/') }}' + "/" + id)
        }
    </script>
@endsection
