<?php

namespace App\Http\Requests\Orders;

use App\Rules\ValidSponsored;
use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules()
    {
        return [
            'token' => 'required',
            'sponsored' => ['required', new ValidSponsored()]
        ];
    }
}
