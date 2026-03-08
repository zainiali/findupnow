@extends('admin.master_layout')
@section('title')
    <title>{{ __('Menu visibility') }}</title>
@endsection
@section('admin-content')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('Menu visibility') }}</h1>

            </div>

            <div class="section-body">
                <div class="row mt-4">
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('admin.update-menu-visibility') }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <table class="table table-bordered">
                                        <thead>
                                            <th>{{ __('Default Name') }}</th>
                                            <th>{{ __('Custom Name') }}</th>
                                            <th>{{ __('Visibility') }}</th>
                                        </thead>
                                        <tbody>
                                            @foreach ($menus as $menu)
                                                <tr>
                                                    <td width="33%">{{ $menu->menu_name }}</td>
                                                    <td width="33%">
                                                        <input name="ids[]" type="hidden" value="{{ $menu->id }}">
                                                        <input class="form-control" name="custom_names[]" type="text"
                                                            value="{{ $menu->custom_name }}" required>
                                                    </td>
                                                    <td width="33%">
                                                        <select class="form-control" id="" name="status[]">
                                                            <option value="1"
                                                                {{ $menu->status == 1 ? 'selected' : '' }}>
                                                                {{ __('Active') }}</option>
                                                            <option value="0"
                                                                {{ $menu->status == 0 ? 'selected' : '' }}>
                                                                {{ __('Inactive') }}</option>
                                                        </select>

                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <button class="btn btn-primary">{{ __('Update') }}</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
    </div>
@endsection
