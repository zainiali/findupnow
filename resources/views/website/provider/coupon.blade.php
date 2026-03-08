@extends('website.provider.master_layout')
@section('title')
    <title>{{ __('Manage Coupon') }}</title>
@endsection
@section('provider-content')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('Manage Coupon') }}</h1>
            </div>

            <div class="section-body">
                <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#create_coupon_id" href="javascript:;"><i
                        class="fas fa-plus"></i> {{ __('Add New') }}</a>
                <div class="row mt-sm-4">
                    <div class="col-12">
                        <div class="card ">
                            <div class="card-body">
                                <div class="table-responsive table-invoice">
                                    <table class="table table-striped" id="dataTable">
                                        <thead>
                                            <tr>
                                                <th>{{ __('SN') }}</th>
                                                <th>{{ __('Coupon Code') }}</th>
                                                <th>{{ __('Offer') }}</th>
                                                <th>{{ __('End time') }}</th>
                                                <th>{{ __('Status') }}</th>
                                                <th>{{ __('Action') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($coupons as $index => $coupon)
                                                <tr>
                                                    <td>{{ ++$index }}</td>
                                                    <td>{{ $coupon->coupon_code }}</td>
                                                    <td>{{ $coupon->offer_percentage }}%</td>

                                                    <td>{{ date('d M Y', strtotime($coupon->expired_date)) }}</td>

                                                    <td>
                                                        @if ($coupon->status == 1)
                                                            <span class="badge badge-success">{{ __('Active') }}</span>
                                                        @else
                                                            <span class="badge badge-danger">{{ __('Inactive') }}</span>
                                                        @endif
                                                    </td>

                                                    <td>

                                                        <a class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                                            data-bs-target="#edit_coupon_id_{{ $coupon->id }}"
                                                            href="javascript:;"><i class="fa fa-edit"
                                                                aria-hidden="true"></i></a>

                                                        <a class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                            data-bs-target="#deleteModal" href="javascript:;"
                                                            onclick="deleteData({{ $coupon->id }})"><i
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
            </div>
        </section>
    </div>

    @foreach ($coupons as $index => $coupon)
        <div class="modal fade" id="edit_coupon_id_{{ $coupon->id }}" role="dialog" aria-labelledby="modelTitleId"
            aria-hidden="true" tabindex="-1">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ __('Create Coupon') }}</h5>
                        <button class="btn btn-sm btn-danger" data-dismiss="modal" type="button" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <form action="{{ route('provider.coupon.update', $coupon->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="">{{ __('Coupon Code') }} <span
                                            class="text-danger">*</span></label>
                                    <input class="form-control" name="coupon_code" type="text"
                                        value="{{ $coupon->coupon_code }}" autocomplete="off">
                                </div>

                                <div class="form-group">
                                    <label for="">{{ __('Offer') }}(%) <span class="text-danger">*</span></label>
                                    <input class="form-control" name="offer_percentage" type="text"
                                        value="{{ $coupon->offer_percentage }}" autocomplete="off">
                                </div>

                                <div class="form-group">
                                    <label for="">{{ __('End time') }} <span class="text-danger">*</span></label>
                                    <input class="form-control datepicker" name="expired_date" type="text"
                                        value="{{ $coupon->expired_date }}" autocomplete="off">
                                </div>

                                <div class="form-group">
                                    <label>{{ __('Status') }} <span class="text-danger">*</span></label>
                                    <select class="form-control" id="" name="status">
                                        <option value="1" {{ $coupon->status == 1 ? 'selected' : '' }}>
                                            {{ __('Active') }}</option>
                                        <option value="0" {{ $coupon->status == 0 ? 'selected' : '' }}>
                                            {{ __('Inactive') }}</option>
                                    </select>
                                </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-dismiss="modal" type="button">{{ __('Close') }}</button>
                        <button class="btn btn-primary" type="submit">{{ __('Update') }}</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

    <!-- Modal -->
    <div class="modal fade" id="create_coupon_id" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true"
        tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('Create Coupon') }}</h5>
                    <button class="btn btn-sm btn-danger" data-dismiss="modal" type="button" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <form action="{{ route('provider.coupon.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="">{{ __('Coupon Code') }} <span class="text-danger">*</span></label>
                                <input class="form-control" name="coupon_code" type="text" autocomplete="off">
                            </div>

                            <div class="form-group">
                                <label for="">{{ __('Offer') }}(%) <span class="text-danger">*</span></label>
                                <input class="form-control" name="offer_percentage" type="text" autocomplete="off">
                            </div>

                            <div class="form-group">
                                <label for="">{{ __('End time') }} <span class="text-danger">*</span></label>
                                <input class="form-control datepicker" name="expired_date" type="text"
                                    autocomplete="off">
                            </div>

                            <div class="form-group">
                                <label>{{ __('Status') }} <span class="text-danger">*</span></label>
                                <select class="form-control" id="" name="status">
                                    <option value="1">{{ __('Active') }}</option>
                                    <option value="0">{{ __('Inactive') }}</option>
                                </select>
                            </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-dismiss="modal" type="button">{{ __('Close') }}</button>
                    <button class="btn btn-primary" type="submit">{{ __('Save') }}</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function deleteData(id) {
            $("#deleteForm").attr("action", '{{ url('provider/coupon/') }}' + "/" + id)
        }
    </script>
@endsection
