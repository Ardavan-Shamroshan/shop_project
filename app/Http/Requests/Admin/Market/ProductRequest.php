<?php

namespace App\Http\Requests\Admin\Market;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if ($this->isMethod('post'))
            return [
                'name' => 'required|max:120|min:2',
                'introduction' => 'required|max:20480|min:5',
                'weight' => 'required|max:1000|min:1|numeric',
                'length' => 'required|max:1000|min:1|numeric',
                'width' => 'required|max:1000|min:1|numeric',
                'height' => 'required|max:1000|min:1|numeric',
                'price' => 'required|numeric',
                'image' => 'required|image|mimes:png,jpg,jpeg,gif',
                'status' => 'required|numeric|in:0,1',
                'marketable' => 'required|numeric|in:0,1',
                'tags' => 'nullable',
                'category_id' => 'required|min:1|max:100000000|exists:product_categories,id',
                'brand_id' => 'required|min:1|max:100000000|exists:brands,id',
                'published_at' => 'required|numeric',
                'meta_key.*' => 'required',
                'meta_value.*' => 'required',
            ];
        else {
            return [
                'name' => 'required|max:120|min:2',
                'introduction' => 'required|max:20480|min:5',
                'weight' => 'required|max:1000|min:1|numeric',
                'length' => 'required|max:1000|min:1|numeric',
                'width' => 'required|max:1000|min:1|numeric',
                'height' => 'required|max:1000|min:1|numeric',
                'price' => 'required|numeric',
                'image' => 'image|mimes:png,jpg,jpeg,gif',
                'status' => 'required|numeric|in:0,1',
                'marketable' => 'required|numeric|in:0,1',
                'tags' => 'nullable',
                'category_id' => 'required|min:1|max:100000000|exists:product_categories,id',
                'brand_id' => 'required|min:1|max:100000000|exists:brands,id',
                'published_at' => 'required|numeric',
                'meta_key.*' => 'required',
                'meta_value.*' => 'required',
            ];
        }
    }

    public function attributes()
    {
        return [
            'meta_key.*' => 'ویژگی',
            'meta_value.*' => 'مقدار',
        ];
    }
}
