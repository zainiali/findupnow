@extends('admin.master_layout')
@section('title')
    <title>{{ __('Manage Kyc') }}</title>
@endsection
@section('admin-content')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('Manage Kyc') }}</h1>
            </div>

            <div class="section-body">
                <div class="row mt-sm-4">
                    <div class="col-12">
                        <div class="card ">
                            <div class="card-body">
                                <div class="table-responsive table-invoice">
                                    <table class="table table-striped" id="dataTable">
                                        <thead>
                                            <tr>
                                                <th>{{ __('SN') }}</th>
                                                <th>{{ __('Document') }}</th>
                                                <th>{{ __('Name') }}</th>
                                                <th>{{ __('Document Name') }}</th>
                                                <th>{{ __('Status') }}</th>
                                                <th>{{ __('Action') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($kycs as $index => $kyc)
                                                <tr>
                                                    <td>{{ ++$index }}</td>
                                                    <td>
                                                        <a href="{{ asset($kyc->file) }}">
                                                            <img class="img-thumbnail" src="{{ asset($kyc->file) }}"
                                                                alt="" width="120" @style(['margin: 3px !important'])>
                                                        </a>
                                                    </td>
                                                    <td><a
                                                            href="{{ route('providers', $kyc->influncer->user_name) }}">{{ $kyc->influncer->name }}</a>
                                                    </td>
                                                    <td>{{ $kyc->kyc_type->name }}</td>
                                                    <td>
                                                        @if ($kyc->status == 0)
                                                            <span class="badge badge-danger">{{ __('Pending') }}</span>
                                                        @endif
                                                        @if ($kyc->status == 1)
                                                            <span class="badge badge-success">{{ __('Approved') }}</span>
                                                        @endif
                                                        @if ($kyc->status == 2)
                                                            <span class="badge badge-danger">{{ __('Reject') }}</span>
                                                        @endif
                                                    </td>

                                                    <td>

                                                        <a class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                                            data-bs-target="#edit_coupon_id_{{ $kyc->id }}"
                                                            href="javascript:;"><i class="fa fa-eye"
                                                                aria-hidden="true"></i></a>

                                                        <a class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                            data-bs-target="#deleteModal" href="javascript:;"
                                                            onclick="deleteData({{ $kyc->id }})"><i
                                                                class="fa fa-trash" aria-hidden="true"></i></a>

                                                    </td>

                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                            <div class="card-footer">
                                <div class="d-flex justify-content-center mt-3">
                                    {{ $kycs->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    @foreach ($kycs as $index => $kyc1)
        <div class="modal fade" id="edit_coupon_id_{{ $kyc1->id }}" role="dialog" aria-labelledby="modelTitleId"
            aria-hidden="true" tabindex="-1">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ $kyc->influncer->name }}</h5>
                        <button class="btn btn-danger" data-dismiss="modal" type="button" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <form action="{{ route('admin.update-kyc-status', $kyc1->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <p>
                                    <a href="{{ asset($kyc->file) }}">
                                        <img class="img-thumbnail" src="{{ asset($kyc->file) }}" alt=""
                                            width="120" @style(['margin: 3px !important'])>
                                    </a>
                                </p>

                                <p><b>{{ __('Message') }}:</b> {{ $kyc1->message }}</p>

                                <div class="form-group">
                                    <label class="form-label">{{ __('Status') }} <span
                                            class="text-danger">*</span></label>
                                    <select class="form-select" id="" name="status">
                                        <option value="0" {{ $kyc1->status == 0 ? 'selected' : '' }}>
                                            {{ __('Pending') }}</option>
                                        <option value="1" {{ $kyc1->status == 1 ? 'selected' : '' }}>
                                            {{ __('Approved') }}</option>
                                        <option value="2" {{ $kyc1->status == 2 ? 'selected' : '' }}>
                                            {{ __('Reject') }}</option>
                                    </select>
                                </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-danger" data-dismiss="modal" type="button">{{ __('Close') }}</button>
                        <button class="btn btn-primary" type="submit">{{ __('Update') }}</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

    <x-admin.delete-modal />
    <script>
        "use strict"

        function deleteData(id) {
            $("#deleteForm").attr("action", "{{ url('admin/delete-kyc-info/') }}" + "/" + id)
        }
    </script>
@endsection
