<?php

namespace Modules\JobPost\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JobPostRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if ($this->isMethod('post')) {
            $rules = [
                'user_id'       => 'required',
                'category_id'   => 'required',
                'city_id'       => 'required',
                'title'         => 'required',
                'slug'          => 'required|unique:job_posts',
                'description'   => 'required',
                'regular_price' => 'required|numeric',
                'address'       => 'required',
                'thumb_image'   => 'required',
                'job_type'      => 'required',
            ];
        }

        if ($this->isMethod('put')) {
            $rules = [
                'user_id'       => 'required',
                'category_id'   => 'required',
                'city_id'       => 'required',
                'title'         => 'required',
                'slug'          => 'required',
                'description'   => 'required',
                'regular_price' => 'required|numeric',
                'address'       => 'required',
                'thumb_image'   => 'sometimes|required',
            ];
        }

        return $rules;

    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function messages(): array
    {
        return [
            'user_id.required'       => __('User is required'),
            'category_id.required'   => __('Category is required'),
            'city_id.required'       => __('City is required'),
            'title.required'         => __('Title is required'),
            'slug.required'          => __('Slug is required'),
            'slug.unique'            => __('Slug already exist'),
            'description.required'   => __('Description is required'),
            'regular_price.required' => __('Price is required'),
            'regular_price.numeric'  => __('Price should be numeric'),
            'address.required'       => __('Address is required'),
            'thumb_image.required'   => __('Image is required'),
        ];
    }
}
