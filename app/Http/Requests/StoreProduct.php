<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreProduct extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'sku' => 'required|unique:products',
            'name' => 'required|string|max:50',
            'img' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'price' => 'required|int',
            'quantity'=>'required|int',
            'discount'=>'required|int|max:99'
        ];
    }
}
