<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
        return[                                              //バリデーション
            'brand_id'=> ['required', 'exists:brands,id'],
            'number' => ['required', 'string', 'max:50'],
            'name' => ['required', 'string', 'max:50'],
            'information' => ['nullable', 'string', 'max:1000'],
            'price' => ['required', 'integer'],
            'sort_order' => ['required', 'integer'],
            'price' => ['nullable', 'integer'],
            'quantity' => ['required', 'integer', 'between:0,999'],
            'category' => ['required', 'exists:secondary_categories,id'],
            'image1' => ['nullable', 'exists:images,id'],
            'image2' => ['nullable', 'exists:images,id'],
            'image3' => ['nullable', 'exists:images,id'],
            'image4' => ['nullable', 'exists:images,id'],
            'image5' => ['nullable', 'exists:images,id'],
            'image6' => ['nullable', 'exists:images,id'],
            'image7' => ['nullable', 'exists:images,id'],
            'image8' => ['nullable', 'exists:images,id'],
            'image9' => ['nullable', 'exists:images,id'],
            'image10' => ['nullable', 'exists:images,id'],
            'is_selling' => ['required','boolean'],
        ];
    }
}
