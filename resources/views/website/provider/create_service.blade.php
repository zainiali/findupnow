@extends('website.provider.master_layout')
@section('title')
    <title>{{ __('Create Service') }}</title>
@endsection
@section('provider-content')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('Create Service') }}</h1>

            </div>

            <form id="serviceForm" action="{{ route('provider.service.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="section-body">
                    <div class="row mt-sm-4">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>{{ __('Basic Information') }}</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-12">
                                            <label>{{ __('Image') }} <span class="text-danger">*</span></label>
                                            <input class="form-control" name="image" type="file">
                                        </div>
                                        <div class="form-group col-12">
                                            <label>{{ __('Service Name') }} <span class="text-danger">*</span></label>
                                            <input class="form-control" id="name" name="name" type="text">
                                        </div>

                                        <div class="form-group col-12">
                                            <label>{{ __('Slug') }} <span class="text-danger">*</span></label>
                                            <input class="form-control" id="slug" name="slug" type="text">
                                        </div>

                                        <div class="form-group col-12">
                                            <label>{{ __('Price') }} <span class="text-danger">*</span></label>
                                            <input class="form-control" name="price" type="text">
                                        </div>

                                        <div class="form-group col-12">
                                            <label>{{ __('Category') }} <span class="text-danger">*</span></label>
                                            <select class="form-control select2" id="" name="category_id">
                                                <option value="">{{ __('Select') }}</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group col-12">
                                            <label>{{ __('Details') }} <span class="text-danger">*</span></label>
                                            <textarea class="summernote" id="" name="details" cols="30" rows="10"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="section-body">
                    <div class="row mt-sm-4">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>{{ __('Package Features') }}</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row" id="package_feature_box">
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="form-group col-md-10">
                                                    <label>{{ __('Service') }}</label>
                                                    <input class="form-control" name="package_features[]" type="text"
                                                        autocomplete="off">
                                                </div>
                                                <div class="col-md-2">
                                                    <button class="btn btn-success btn_mt_33" id="addNewPackageFeature"
                                                        type="button" type="button"><i class="fa fa-plus"
                                                            aria-hidden="true"></i> {{ __('Add New') }}</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="section-body">
                    <div class="row mt-sm-4">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>{{ __('What you will provide ?') }}</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row" id="provide_item_box">
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="form-group col-md-10">
                                                    <label>{{ __('Title') }}</label>
                                                    <input class="form-control" name="what_you_will_provides[]"
                                                        type="text" autocomplete="off">
                                                </div>
                                                <div class="col-md-2">
                                                    <button class="btn btn-success btn_mt_33" id="addNewProvideItem"
                                                        type="button" type="button"><i class="fa fa-plus"
                                                            aria-hidden="true"></i> {{ __('Add New') }}</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="section-body">
                    <div class="row mt-sm-4">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>{{ __('Benifits of the Package') }}</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row" id="benifit_box">
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="form-group col-md-10">
                                                    <label>{{ __('Title') }}</label>
                                                    <input class="form-control" name="benifits[]" type="text"
                                                        autocomplete="off">
                                                </div>
                                                <div class="col-md-2">
                                                    <button class="btn btn-success btn_mt_33" id="addNewBenifitItem"
                                                        type="button"><i class="fa fa-plus" aria-hidden="true"></i>
                                                        {{ __('Add New') }}</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="section-body">
                    <div class="row mt-sm-4">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>{{ __('Additional service') }}</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row" id="additional_box">
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="form-group col-md-3">
                                                    <label>{{ __('Image') }}</label>
                                                    <input class="form-control" name="additional_feature_images[]"
                                                        type="file">
                                                </div>

                                                <div class="form-group col-md-3">
                                                    <label>{{ __('Service') }}</label>
                                                    <input class="form-control" name="additional_services[]"
                                                        type="text" autocomplete="off">
                                                </div>

                                                <div class="form-group col-md-2">
                                                    <label>{{ __('Quantity') }}</label>
                                                    <input class="form-control" name="additional_quantities[]"
                                                        type="text" autocomplete="off">
                                                </div>

                                                <div class="form-group col-md-2">
                                                    <label>{{ __('Price') }}</label>
                                                    <input class="form-control" name="additional_prices[]" type="text"
                                                        autocomplete="off">
                                                </div>

                                                <div class="col-md-2">
                                                    <button class="btn btn-success btn_mt_33" id="addNewAdditionalService"
                                                        type="button"><i class="fa fa-plus" aria-hidden="true"></i>
                                                        {{ __('Add New') }}</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="section-body">
                    <div class="row mt-sm-4">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>{{ __('Seo Information') }}</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-12">
                                            <label>{{ __('Seo Title') }}</label>
                                            <input class="form-control" name="seo_title" type="text"
                                                autocomplete="off">
                                        </div>
                                        <div class="form-group col-12">
                                            <label>{{ __('Seo Description') }}</label>
                                            <textarea class="form-control text-area-5" id="" name="seo_description" cols="30" rows="10"></textarea>
                                        </div>
                                    </div>

                                    <button class="btn btn-primary" type="submit">{{ __('Save New Service') }}</button>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </form>

        </section>
    </div>

    <script>
        (function($) {
            "use strict";
            $(document).ready(function() {
                $("#name").on("keyup", function(e) {
                    $("#slug").val(convertToSlug($(this).val()));
                })
                // start package feature section
                $("#addNewPackageFeature").on("click", function() {
                    let package_feature = `
                    <div class="col-12 pacakge_feature_row">
                        <div class="row">
                            <div class="form-group col-md-10">
                                <label>{{ __('Service') }}</label>
                                <input type="text" class="form-control" name="package_features[]" autocomplete="off">
                            </div>
                            <div class="col-md-2">
                            <button type="button" class="btn btn-danger btn_mt_33 delete_package_feature"><i class="fa fa-trash" aria-hidden="true"></i> {{ __('Remove') }}</button>
                            </div>
                        </div>
                    </div>`;
                    $("#package_feature_box").append(package_feature)
                });

                $(document).on('click', '.delete_package_feature', function() {
                    $(this).closest('.pacakge_feature_row').remove();
                });

                // end package feature

                // start provide item
                $("#addNewProvideItem").on("click", function() {
                    let provide_item = `
                    <div class="col-12 provide_item_row">
                        <div class="row">
                            <div class="form-group col-md-10">
                                <label>{{ __('Title') }}</label>
                                <input type="text" class="form-control" name="what_you_will_provides[]" autocomplete="off">
                            </div>
                            <div class="col-md-2">
                                <button type="button" class="btn btn-danger btn_mt_33 delete_provide_item"><i class="fa fa-trash" aria-hidden="true"></i> {{ __('Remove') }}</button>
                            </div>
                        </div>
                    </div>`;
                    $("#provide_item_box").append(provide_item)
                })

                $(document).on('click', '.delete_provide_item', function() {
                    $(this).closest('.provide_item_row').remove();
                });
                // end provide item

                // start benifit item
                $("#addNewBenifitItem").on("click", function() {
                    let provide_item = `
                    <div class="col-12 benitfit_item_row">
                            <div class="row">
                                <div class="form-group col-md-10">
                                    <label>{{ __('Title') }}</label>
                                    <input type="text" class="form-control" name="benifits[]" autocomplete="off">
                                </div>
                                <div class="col-md-2">
                                    <button type="button" type="button" class="btn btn-danger btn_mt_33 delete_benifit_item"><i class="fa fa-trash" aria-hidden="true"></i> {{ __('Remove') }}</button>
                                </div>
                            </div>
                    </div>`;
                    $("#benifit_box").append(provide_item)
                })

                $(document).on('click', '.delete_benifit_item', function() {
                    $(this).closest('.benitfit_item_row').remove();
                });
                // end benifit

                $("#addNewAdditionalService").on("click", function() {
                    let additional_service = `
                    <div class="col-12 additional_item_box">
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label>{{ __('Image') }}</label>
                                <input type="file" class="form-control" name="additional_feature_images[]">
                            </div>

                            <div class="form-group col-md-3">
                                <label>{{ __('Service') }}</label>
                                <input type="text" class="form-control" name="additional_services[]" autocomplete="off">
                            </div>

                            <div class="form-group col-md-2">
                                <label>{{ __('Quantity') }}</label>
                                <input type="text" class="form-control" name="additional_quantities[]" autocomplete="off">
                            </div>

                            <div class="form-group col-md-2">
                                <label>{{ __('Price') }}</label>
                                <input type="text" class="form-control" name="additional_prices[]" autocomplete="off">
                            </div>

                            <div class="col-md-2">
                                <button type="button" type="button" class="btn btn-danger btn_mt_33 delete_additional_service"><i class="fa fa-trash" aria-hidden="true"></i> {{ __('Remove') }}</button>
                            </div>
                        </div>
                    </div>
                `;
                    $("#additional_box").append(additional_service)
                })

                $(document).on('click', '.delete_additional_service', function() {
                    $(this).closest('.additional_item_box').remove();
                });

            })
        })(jQuery);

        function convertToSlug(Text) {
            return Text
                .toLowerCase()
                .replace(/[^\w ]+/g, '')
                .replace(/ +/g, '-');
        }
    </script>
@endsection
