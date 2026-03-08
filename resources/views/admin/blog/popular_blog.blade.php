@extends('admin.master_layout')
@section('title')
    <title>{{ __('Popular Blog') }}</title>
@endsection
@section('admin-content')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('Popular Blog') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a>
                    </div>
                    <div class="breadcrumb-item active"><a href="{{ route('admin.blog.index') }}">{{ __('Blogs') }}</a>
                    </div>
                    <div class="breadcrumb-item">{{ __('Popular Blog') }}</div>
                </div>
            </div>

            <div class="section-body">
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin.popular-blog.store') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="">{{ __('Blog') }}</label>
                                    <select class="form-control select2" id="" name="blog_id" required>
                                        <option value="">{{ __('Select Blog') }}</option>
                                        @foreach ($blogs as $blog)
                                            <option value="{{ $blog->id }}">{{ $blog->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <button class="btn btn-primary">{{ __('Save') }}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="section-body">
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive table-invoice">
                                <table class="table table-striped" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th width="5%">{{ __('SN') }}</th>
                                            <th width="30%">{{ __('Blog') }}</th>
                                            <th width="15%">{{ __('Category') }}</th>
                                            <th width="10%">{{ __('Image') }}</th>
                                            <th width="15%">{{ __('Status') }}</th>
                                            <th width="15%">{{ __('Action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($popularBlogs as $index => $popularBlog)
                                            <tr>
                                                <td>{{ ++$index }}</td>
                                                <td>{{ $popularBlog->blog->title }}</td>
                                                <td>{{ $popularBlog->blog->category->name }}</td>
                                                <td><img class="rounded-circle"
                                                        src="{{ asset($popularBlog->blog->image) }}" alt=""
                                                        width="80px"></td>
                                                <td>
                                                    @if ($popularBlog->status == 1)
                                                        <a href="javascript:;"
                                                            onclick="changePopularBlogStatus({{ $popularBlog->id }})">
                                                            <input id="status_toggle" data-toggle="toggle"
                                                                data-on="{{ __('Active') }}"
                                                                data-off="{{ __('Inactive') }}" data-onstyle="success"
                                                                data-offstyle="danger" type="checkbox" checked>
                                                        </a>
                                                    @else
                                                        <a href="javascript:;"
                                                            onclick="changePopularBlogStatus({{ $popularBlog->id }})">
                                                            <input id="status_toggle" data-toggle="toggle"
                                                                data-on="{{ __('Active') }}"
                                                                data-off="{{ __('Inactive') }}" data-onstyle="success"
                                                                data-offstyle="danger" type="checkbox">
                                                        </a>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                        data-bs-target="#deleteModal" href="javascript:;"
                                                        onclick="deleteData({{ $popularBlog->id }})"><i class="fa fa-trash"
                                                            aria-hidden="true"></i></a>
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
            $("#deleteForm").attr("action", "{{ url('admin/popular-blog/') }}" + "/" + id)
        }

        function changePopularBlogStatus(id) {
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
                url: "{{ url('/admin/popular-blog-status/') }}" + "/" + id,
                success: function(response) {
                    toastr.success(response)
                },
                error: function(err) {

                }
            })
        }
    </script>
@endsection
