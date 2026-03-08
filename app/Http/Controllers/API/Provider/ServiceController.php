<?php

namespace App\Http\Controllers\API\Provider;

use App\Http\Controllers\Controller;
use App\Models\AdditionalService;
use App\Models\Category;
use App\Models\Review;
use App\Models\Service;
use App\Models\Setting;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class ServiceController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:api', 'checkprovider.api']);
    }

    public function index()
    {
        $user = Auth::guard('api')->user();

        $services = Service::with('category')->orderBy('id', 'desc')->where('provider_id', $user->id)->paginate(15);

        $setting       = Setting::first();
        $currency_icon = [
            'icon' => getApiCurrencyIcon(),
        ];
        $currency_icon = (object) $currency_icon;
        $title         = __('All Service');

        return response()->json([
            'title'         => $title,
            'services'      => $services,
            'currency_icon' => $currency_icon,
        ]);
    }

    public function awaitingForApproval()
    {
        $user     = Auth::guard('api')->user();
        $services = Service::with('category')->orderBy('id', 'desc')->where('approve_by_admin', 0)->where('provider_id', $user->id)->paginate(15);

        $setting       = Setting::first();
        $currency_icon = [
            'icon' => getApiCurrencyIcon(),
        ];
        $currency_icon = (object) $currency_icon;
        $title         = __('Awaiting for Approval');

        return response()->json([
            'title'         => $title,
            'services'      => $services,
            'currency_icon' => $currency_icon,
        ]);
    }

    public function activeService()
    {
        $user     = Auth::guard('api')->user();
        $services = Service::with('category')->orderBy('id', 'desc')->where('approve_by_admin', 1)->where('status', 1)->where('provider_id', $user->id)->paginate(15);

        $setting       = Setting::first();
        $currency_icon = [
            'icon' => getApiCurrencyIcon(),
        ];
        $currency_icon = (object) $currency_icon;
        $title         = __('Active Service');
        return response()->json([
            'title'         => $title,
            'services'      => $services,
            'currency_icon' => $currency_icon,
        ]);
    }

    public function bannedService()
    {
        $user     = Auth::guard('api')->user();
        $services = Service::with('category')->orderBy('id', 'desc')->where('is_banned', 1)->where('provider_id', $user->id)->paginate(15);

        $setting       = Setting::first();
        $currency_icon = [
            'icon' => getApiCurrencyIcon(),
        ];
        $currency_icon = (object) $currency_icon;
        $title         = __('Banned Service');
        return response()->json([
            'title'         => $title,
            'services'      => $services,
            'currency_icon' => $currency_icon,
        ]);
    }

    public function create()
    {
        $categories = Category::where('status', 1)->get()->append('name');

        return response()->json(['categories' => $categories]);
    }

    /**
     * @param Request $request
     */
    public function store(Request $request)
    {
        $rules = [
            'name'        => 'required',
            'slug'        => 'required|unique:services',
            'price'       => 'required',
            'category_id' => 'required',
            'details'     => 'required',
            'image'       => 'required',
        ];

        $customMessages = [
            'name.required'        => __('Name is required'),
            'slug.required'        => __('Slug is required'),
            'slug.unique'          => __('Slug already exist'),
            'price.required'       => __('Price is required'),
            'category_id.required' => __('Category is required'),
            'details.required'     => __('Details is required'),
            'image.required'       => __('Image is required'),
        ];

        $this->validate($request, $rules, $customMessages);

        try {
            DB::beginTransaction();

            $user    = Auth::guard('api')->user();
            $service = new Service();

            if ($request->file('image')) {
                $service->image = saveFileGetPath($request->image);
            }

            $package_features   = [];
            $is_pacakge_feature = false;
            foreach ($request->package_features as $package_feature) {
                if ($package_feature) {
                    $package_features[] = $package_feature;
                    $is_pacakge_feature = true;
                }
            }
            $package_features = json_encode($package_features);

            $what_you_will_provides   = [];
            $is_what_you_will_provide = false;
            foreach ($request->what_you_will_provides as $what_you_will_provide) {
                if ($what_you_will_provide) {
                    $is_what_you_will_provide = true;
                    $what_you_will_provides[] = $what_you_will_provide;
                }
            }
            $what_you_will_provides = json_encode($what_you_will_provides);

            $benifits   = [];
            $is_benifit = false;
            foreach ($request->benifits as $benifit) {
                if ($benifit) {
                    $benifits[] = $benifit;
                    $is_benifit = true;
                }

            }
            $benifits = json_encode($benifits);

            $service->provider_id           = $user->id;
            $service->category_id           = $request->category_id;
            $service->name                  = $request->name;
            $service->slug                  = $request->slug;
            $service->price                 = $request->price;
            $service->details               = $request->details;
            $service->seo_title             = $request->seo_title ? $request->seo_title : $request->name;
            $service->seo_description       = $request->seo_description ? $request->seo_description : $request->name;
            $service->status                = 1;
            $service->package_features      = $is_pacakge_feature ? $package_features : '';
            $service->what_you_will_provide = $is_what_you_will_provide ? $what_you_will_provides : '';
            $service->benifit               = $is_benifit ? $benifits : '';
            $service->save();

            if (
                is_array($request->additional_services) &&
                is_array($request->additional_quantities) &&
                is_array($request->additional_prices) &&
                is_array($request->additional_feature_images)
            ) {
                $total = min(
                    count($request->additional_services),
                    count($request->additional_quantities),
                    count($request->additional_prices),
                    count($request->additional_feature_images)
                );

                for ($i = 0; $i < $total; $i++) {
                    $serviceName = $request->additional_services[$i] ?? null;
                    $quantity    = $request->additional_quantities[$i] ?? null;
                    $price       = $request->additional_prices[$i] ?? null;
                    $image       = $request->additional_feature_images[$i] ?? null;

                    if (
                        !empty($serviceName) &&
                        !empty($quantity) &&
                        !empty($price) &&
                        $image instanceof \Illuminate\Http\UploadedFile
                    ) {
                        $additional_service               = new AdditionalService();
                        $additional_service->image        = saveFileGetPath($image);
                        $additional_service->service_name = $serviceName;
                        $additional_service->qty          = $quantity;
                        $additional_service->price        = $price;
                        $additional_service->service_id   = $service->id;
                        $additional_service->save();
                    }
                }
            }
            DB::commit();
            $notification = __('Created Successfully');
        } catch (Exception $e) {
            DB::rollBack();
            logger($e);
            $notification = __('Service not created!');
        }

        return response()->json(['message' => $notification]);
    }

    /**
     * @param $id
     */
    public function edit($id)
    {
        $categories = Category::where('status', 1)->get();
        $service    = Service::find($id);

        $package_features = [];
        if ($service->package_features) {
            $features = json_decode($service->package_features);
            foreach ($features as $feature) {
                $package_features[] = $feature;
            }
        }

        $what_you_will_provides = [];
        if ($service->what_you_will_provide) {
            $provides = json_decode($service->what_you_will_provide);
            foreach ($provides as $provide) {
                $what_you_will_provides[] = $provide;
            }
        }

        $benifits = [];
        if ($service->benifit) {
            $exist_benifits = json_decode($service->benifit);
            foreach ($exist_benifits as $exist_benifit) {
                $benifits[] = $exist_benifit;
            }
        }

        $additional_services = AdditionalService::where('service_id', $id)->get();

        return response()->json([
            'categories'             => $categories,
            'service'                => $service,
            'package_features'       => $package_features,
            'what_you_will_provides' => $what_you_will_provides,
            'benifits'               => $benifits,
            'additional_services'    => $additional_services,
        ]);
    }

    /**
     * @param Request $request
     * @param $id
     */
    public function update(Request $request, $id)
    {
        $service = Service::find($id);

        $rules = [
            'name'        => 'required',
            'slug'        => 'required|unique:services,slug,' . $service->id,
            'price'       => 'required',
            'category_id' => 'required',
            'details'     => 'required',
        ];

        $customMessages = [
            'name.required'        => __('Name is required'),
            'slug.required'        => __('Slug is required'),
            'slug.unique'          => __('Slug already exist'),
            'price.required'       => __('Price is required'),
            'category_id.required' => __('Category is required'),
            'details.required'     => __('Details is required'),
        ];

        $this->validate($request, $rules, $customMessages);

        try {
            DB::beginTransaction();

            if ($request->file('image')) {
                $service->image = saveFileGetPath($request->image, oldFile: $service->image);
                $service->save();
            }

            $package_features   = [];
            $is_pacakge_feature = false;
            foreach ($request->package_features as $package_feature) {
                if ($package_feature) {
                    $package_features[] = $package_feature;
                    $is_pacakge_feature = true;
                }
            }
            $package_features = json_encode($package_features);

            $what_you_will_provides   = [];
            $is_what_you_will_provide = false;
            foreach ($request->what_you_will_provides as $what_you_will_provide) {
                if ($what_you_will_provide) {
                    $is_what_you_will_provide = true;
                    $what_you_will_provides[] = $what_you_will_provide;
                }
            }
            $what_you_will_provides = json_encode($what_you_will_provides);

            $benifits   = [];
            $is_benifit = false;
            foreach ($request->benifits as $benifit) {
                if ($benifit) {
                    $benifits[] = $benifit;
                    $is_benifit = true;
                }

            }
            $benifits = json_encode($benifits);

            $service->category_id           = $request->category_id;
            $service->name                  = $request->name;
            $service->slug                  = $request->slug;
            $service->price                 = $request->price;
            $service->details               = $request->details;
            $service->seo_title             = $request->seo_title ? $request->seo_title : $request->name;
            $service->seo_description       = $request->seo_description ? $request->seo_description : $request->name;
            $service->package_features      = $is_pacakge_feature ? $package_features : '';
            $service->what_you_will_provide = $is_what_you_will_provide ? $what_you_will_provides : '';
            $service->benifit               = $is_benifit ? $benifits : '';
            if ($service->approve_by_admin == 1) {
                $service->status = $request->status;
            }
            $service->save();

            if (is_array($request->ids) && count($request->ids) > 0) {
                foreach ($request->ids as $index => $id) {
                    $serviceName = $request->exist_additional_services[$index] ?? null;
                    $qty         = $request->exist_additional_quantities[$index] ?? null;
                    $price       = $request->exist_additional_prices[$index] ?? null;
                    $imageField  = 'exist_additional_feature_image_' . $id;
                    $imageFile   = $request->file($imageField);

                    if (!empty($id) && !empty($serviceName) && !empty($qty) && !empty($price)) {
                        $additional_service = AdditionalService::find($id);

                        if ($additional_service) {
                            $additional_service->service_name = $serviceName;
                            $additional_service->qty          = $qty;
                            $additional_service->price        = $price;

                            if ($imageFile instanceof \Illuminate\Http\UploadedFile) {
                                $additional_service->image = saveFileGetPath($imageFile, oldFile: $additional_service->image);
                            }

                            $additional_service->save();
                        } else {
                            Log::warning("AdditionalService ID {$id} not found.");
                        }
                    }
                }
            } else {
                // No IDs submitted, so delete all related to this service
                $additional_services = AdditionalService::where('service_id', $service->id)->get();

                foreach ($additional_services as $additional_service) {
                    $existingImage = $additional_service->image;

                    if ($additional_service->delete() && $existingImage && File::exists(public_path($existingImage))) {
                        @unlink(public_path($existingImage));
                    }
                }
            }

            // Handle new additions
            $services      = $request->additional_services ?? [];
            $quantities    = $request->additional_quantities ?? [];
            $prices        = $request->additional_prices ?? [];
            $featureImages = $request->file('additional_feature_images', []);

            if (
                is_array($services) &&
                is_array($quantities) &&
                is_array($prices) &&
                is_array($featureImages)
            ) {
                $total = min(count($services), count($quantities), count($prices), count($featureImages));

                for ($i = 0; $i < $total; $i++) {
                    $serviceName = $services[$i] ?? null;
                    $qty         = $quantities[$i] ?? null;
                    $price       = $prices[$i] ?? null;
                    $imageFile   = $featureImages[$i] ?? null;

                    if (!empty($serviceName) && !empty($qty) && !empty($price) && $imageFile instanceof \Illuminate\Http\UploadedFile) {
                        $additional_service               = new AdditionalService();
                        $additional_service->service_name = $serviceName;
                        $additional_service->qty          = $qty;
                        $additional_service->price        = $price;
                        $additional_service->image        = saveFileGetPath($imageFile);
                        $additional_service->service_id   = $service->id;
                        $additional_service->save();
                    }
                }
            }
            DB::commit();
            $notification = __('Update Successfully');
        } catch (Exception $e) {
            logger()->error($e);
            DB::rollBack();
            $notification = __('Update Failed');
        }

        return response()->json(['message' => $notification]);
    }

    /**
     * @param $id
     */
    public function destroy($id)
    {
        $service = Service::where([
            'id'          => $id,
            'provider_id' => Auth::guard('api')->user()->id,
        ])->first();

        if (!$service) {
            $notification = __('Service not found');
            return response()->json(['message' => $notification]);
        }

        $additional_services = AdditionalService::where('service_id', $id)->get();
        foreach ($additional_services as $additional_service) {
            $exist_image = $additional_service->image;
            $additional_service->delete();
            if ($exist_image) {
                if (File::exists(public_path() . '/' . $exist_image)) {
                    unlink(public_path() . '/' . $exist_image);
                }

            }
        }
        $old_image = $service->image;
        $service->delete();
        if ($old_image) {
            if (File::exists(public_path() . '/' . $old_image)) {
                unlink(public_path() . '/' . $old_image);
            }

        }

        Review::where('service_id', $id)->delete();

        $notification = __('Delete Successfully');

        return response()->json(['message' => $notification]);

    }

    public function reviewList()
    {
        $user = Auth::guard('api')->user();

        $reviews = Review::where('provider_id', $user->id)->with('user', 'service')->orderBy('id', 'desc')->get();

        return response()->json(['reviews' => $reviews]);
    }

    /**
     * @param $id
     */
    public function showReview($id)
    {
        $user   = Auth::guard('api')->user();
        $review = Review::where('provider_id', $user->id)->with('user', 'service')->orderBy('id', 'desc')->where('id', $id)->first();

        return response()->json(['review' => $review]);
    }
}
