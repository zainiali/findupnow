@extends('admin.master_layout')
@section('title')
    <title>{{ __('State / Province') }}</title>
@endsection
@section('admin-content')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('State / Province') }}</h1>

            </div>

            <div class="section-body">
                <a class="btn btn-primary" href="{{ route('admin.state.create') }}"><i class="fas fa-plus"></i>
                    {{ __('Create State / Province') }}</a>
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <table class="table table-striped" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th>{{ __('SN') }}</th>
                                            <th>{{ __('State/Province') }}</th>
                                            <th>{{ __('Country/Region') }}</th>
                                            <th>{{ __('Status') }}</th>
                                            <th>{{ __('Action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($states as $index => $state)
                                            <tr>
                                                <td>{{ ++$index }}</td>
                                                <td>{{ $state->name }}</td>
                                                <td>{{ $state->country->name }}</td>
                                                <td>
                                                    @if ($state->status == 1)
                                                        <a href="javascript:;"
                                                            onclick="changeStateStatus({{ $state->id }})">
                                                            <input id="status_toggle" data-toggle="toggle"
                                                                data-on="{{ __('Active') }}"
                                                                data-off="{{ __('InActive') }}" data-onstyle="success"
                                                                data-offstyle="danger" type="checkbox" checked>
                                                        </a>
                                                    @else
                                                        <a href="javascript:;"
                                                            onclick="changeStateStatus({{ $state->id }})">
                                                            <input id="status_toggle" data-toggle="toggle"
                                                                data-on="{{ __('Active') }}"
                                                                data-off="{{ __('InActive') }}" data-onstyle="success"
                                                                data-offstyle="danger" type="checkbox">
                                                        </a>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a class="btn btn-primary btn-sm"
                                                        href="{{ route('admin.state.edit', $state->id) }}"><i
                                                            class="fa fa-edit" aria-hidden="true"></i></a>

                                                    @if ($state->cities->count() == 0)
                                                        <a class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                            data-bs-target="#deleteModal" href="javascript:;"
                                                            onclick="deleteData({{ $state->id }})"><i
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
        </section>
    </div>

    <x-admin.delete-modal />

    <!-- Modal -->
    <div class="modal fade" id="canNotDeleteModal" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true"
        tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    {{ __('You can not delete this state. Because there are one or more cities, users and seller has been created in this state.') }}
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
            $("#deleteForm").attr("action", '{{ url('admin/state/') }}' + "/" + id)
        }

        function changeStateStatus(id) {
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
                url: "{{ url('/admin/state-status/') }}" + "/" + id,
                success: function(response) {
                    toastr.success(response)
                },
                error: function(err) {

                }
            })
        }
    </script>
@endsection
