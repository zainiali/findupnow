@extends('admin.master_layout')
@section('title')
    <title>{{ __('Custom CSS') }}</title>
@endsection
@section('admin-content')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <x-admin.breadcrumb :title="__('Custom CSS')" :list="[
                __('Dashboard') => route('admin.dashboard'),
                __('Settings') => route('admin.settings'),
                __('Custom CSS') => '#',
            ]" />
            <div class="section-body">
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-sm-12">
                                    <div class="border rounded">
                                        <div class="m-0 card">
                                            <div class="card-body">
                                                <form action="{{ route('admin.update-custom-code') }}" method="POST">
                                                    @csrf
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <span class="fa fa-info-circle text--primary"
                                                                    data-bs-toggle="tooltip" data-placement="top"
                                                                    title="{{ __('write your css code here without the style tag') }}"></span>
                                                                <x-admin.form-textarea id="css-editor" name="css"
                                                                    value="{!! old('css', $customCode?->css) !!}"
                                                                    label="{{ __('Custom CSS') }}" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <x-admin.update-button :text="__('Update')" />
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('css')
    <link href="{{ asset('backend/codemirror/codemirror.css') }}" rel="stylesheet">
@endpush

@push('js')
    <script src="{{ asset('backend/codemirror/codemirror.js') }}"></script>
    <script src="{{ asset('backend/codemirror/javascript.js') }}"></script>
    <script src="{{ asset('backend/codemirror/css.js') }}"></script>

    <script>
        "use strict";

        var editor = CodeMirror.fromTextArea(document.getElementById('css-editor'), {
            mode: "css",
            lineNumbers: true,
            lineWrapping: true,
            autocorrect: true,
        });
        editor.save()
    </script>
@endpush
