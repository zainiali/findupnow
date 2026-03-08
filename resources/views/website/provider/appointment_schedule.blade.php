@extends('website.provider.master_layout')
@section('title')
    <title>{{ __('Appointment Schedule') }}</title>
@endsection
@section('provider-content')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('Appointment Schedule') }}</h1>
            </div>

            <div class="section-body">
                <a class="btn btn-primary" href="{{ route('provider.appointment-schedule.create') }}"><i
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
                                                <th>{{ __('Day') }}</th>
                                                <th>{{ __('Start time') }}</th>
                                                <th>{{ __('End time') }}</th>
                                                <th>{{ __('Status') }}</th>
                                                <th>{{ __('Action') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($schedules as $index => $schedule)
                                                <tr>
                                                    <td>{{ ++$index }}</td>
                                                    <td>{{ $schedule->day }}</td>
                                                    <td>{{ date('h:i A', strtotime($schedule->start_time)) }}</td>
                                                    <td>{{ date('h:i A', strtotime($schedule->end_time)) }}</td>
                                                    <td>
                                                        @if ($schedule->status == 1)
                                                            <span class="badge badge-success">{{ __('Active') }}</span>
                                                        @else
                                                            <span class="badge badge-danger">{{ __('Inactive') }}</span>
                                                        @endif
                                                    </td>

                                                    <td>

                                                        <a class="btn btn-primary btn-sm"
                                                            href="{{ route('provider.appointment-schedule.edit', $schedule->id) }}"><i
                                                                class="fa fa-edit" aria-hidden="true"></i></a>

                                                        <a class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                            data-bs-target="#deleteModal" href="javascript:;"
                                                            onclick="deleteData({{ $schedule->id }})"><i
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

    <script>
        function deleteData(id) {
            $("#deleteForm").attr("action", '{{ url('provider/appointment-schedule/') }}' + "/" + id)
        }
    </script>
@endsection
