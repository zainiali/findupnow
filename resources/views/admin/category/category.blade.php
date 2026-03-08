@extends('admin.master_layout')
@section('title')
    <title>{{ __('Category') }}</title>
@endsection
@section('admin-content')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('Category') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a>
                    </div>
                    <div class="breadcrumb-item">{{ __('Category') }}</div>
                </div>
            </div>

            <div class="section-body">
                <a class="btn btn-primary" href="{{ route('admin.category.create') }}"><i class="fas fa-plus"></i>
                    {{ __('Add New') }}</a>
                <div class="row mt-4">
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive table-invoice">
                                    <table class="table table-striped" id="dataTable">
                                        <thead>
                                            <tr>
                                                <th>{{ __('SN') }}</th>
                                                <th>{{ __('Name') }}</th>
                                                @if ($selected_theme == 0 || $selected_theme == 3)
                                                    <th>{{ __('Image') }}</th>
                                                @endif
                                                <th>{{ __('Icon') }}</th>
                                                <th>{{ __('Status') }}</th>
                                                <th>{{ __('Action') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($categories as $index => $category)
                                                <tr>
                                                    <td>{{ ++$index }}</td>
                                                    <td>{{ $category->name }}</td>
                                                    @if ($selected_theme == 0 || $selected_theme == 3)
                                                        <td>
                                                            <img class="w_120" src="{{ asset($category->image) }}"
                                                                alt="">
                                                        </td>
                                                    @endif

                                                    <td>
                                                        <img class="w_80" src="{{ asset($category->icon) }}"
                                                            alt="">
                                                    </td>
                                                    <td>
                                                        @if ($category->status == 1)
                                                            <a href="javascript:;"
                                                                onclick="changeProductCategoryStatus({{ $category->id }})">
                                                                <input id="status_toggle" data-toggle="toggle"
                                                                    data-on="{{ __('Active') }}"
                                                                    data-off="{{ __('Inactive') }}" data-onstyle="success"
                                                                    data-offstyle="danger" type="checkbox" checked>
                                                            </a>
                                                        @else
                                                            <a href="javascript:;"
                                                                onclick="changeProductCategoryStatus({{ $category->id }})">
                                                                <input id="status_toggle" data-toggle="toggle"
                                                                    data-on="{{ __('Active') }}"
                                                                    data-off="{{ __('Inactive') }}" data-onstyle="success"
                                                                    data-offstyle="danger" type="checkbox">
                                                            </a>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a class="btn btn-primary btn-sm"
                                                            href="{{ route('admin.category.edit', ['category' => $category->id, 'code' => getSessionLanguage()]) }}"><i
                                                                class="fa fa-edit" aria-hidden="true"></i></a>

                                                        @if ($category->service->count() == 0)
                                                            <a class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                                data-bs-target="#deleteModal" href="javascript:;"
                                                                onclick="deleteData({{ $category->id }})"><i
                                                                    class="fa fa-trash" aria-hidden="true"></i></a>
                                                        @else
                                                            <a class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                                data-bs-target="#canNotDeleteModal" href="javascript:;"
                                                                disabled><i class="fa fa-trash" aria-hidden="true"></i></a>
                                                        @endif
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

    <!-- Modal -->
    <div class="modal fade" id="canNotDeleteModal" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true"
        tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    {{ __('You can not delete this category. Because there are one or more services has been created in this category.') }}
                </div>

                <div class="modal-footer">
                    <button class="btn btn-danger" data-dismiss="modal" type="button">{{ __('Close') }}</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        "use strict";

        function deleteData(id) {
            $("#deleteForm").attr("action", "{{ url('admin/category/') }}" + "/" + id)
        }

        function changeProductCategoryStatus(id) {
            var isDemo = "{{ env('APP_MODE') }}"
            if (isDemo == 'DEMO') {
                toastr.error('This Is Demo Version. You Can Not Change Anything');
                return;
            }
            $.ajax({
                type: "put",
                data: {
                    _token: '{{ csrf_token() }}'
                },
                url: "{{ url('/admin/category-status/') }}" + "/" + id,
                success: function(response) {
                    toastr.success(response)
                },
                error: function(err) {

                }
            })
        }
    </script>
@endsection
