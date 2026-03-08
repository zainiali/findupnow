@extends('admin.master_layout')
@section('title')
    <title>{{ __('Section Control') }}</title>
@endsection
@section('admin-content')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('Section Control') }}</h1>

            </div>

            <div class="section-body">
                <div class="row mt-4">
                    <div class="col-12">
                        <form action="{{ route('admin.update-section-control') }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="home_border">{{ __('Homepage Section Control') }}</h5>
                                    <hr>

                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th width="33%">{{ __('Section') }}</th>
                                                <th width="33%">{{ __('Visibility') }}</th>
                                                <th width="33%">{{ __('Item Quantity') }}</th>
                                            </tr>
                                        </thead>
                                        @foreach ($homepage as $section)
                                            <tr>
                                                <td>
                                                    {{ $section->section_name }}
                                                </td>

                                                <input name="ids[]" type="hidden" value="{{ $section->id }}">
                                                <td>
                                                    <select class="form-control" name="status[]">
                                                        <option value="1"
                                                            {{ $section->status == 1 ? 'selected' : '' }}>
                                                            {{ __('Enable') }}</option>
                                                        <option value="0"
                                                            {{ $section->status == 0 ? 'selected' : '' }}>
                                                            {{ __('Disable') }}</option>
                                                    </select>
                                                </td>

                                                @if (
                                                    $section->id == 1 ||
                                                        $section->id == 6 ||
                                                        $section->id == 7 ||
                                                        $section->id == 10 ||
                                                        $section->id == 21 ||
                                                        $section->id == 33 ||
                                                        $section->id == 35 ||
                                                        $section->id == 36 ||
                                                        $section->id == 38 ||
                                                        $section->id == 39)
                                                    <td>
                                                        <input class="d-none" class="form-control" name="quanities[]"
                                                            type="text" value="{{ $section->qty }}">
                                                    </td>
                                                @else
                                                    <td>
                                                        <input class="form-control" name="quanities[]" type="text"
                                                            value="{{ $section->qty }}">
                                                    </td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    </table>
                                    <button class="btn btn-primary" type="submit">{{ __('Update') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

        </section>
    </div>
@endsection
