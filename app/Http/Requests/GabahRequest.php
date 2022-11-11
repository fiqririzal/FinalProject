<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GabahRequest extends FormRequest
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
        return [
            'id_pabrik' => 'required',
            'name'      => 'required',
            'detail'  => 'required',
            'price'  => 'required',
            'image'  => 'required',
        ];
    }

    public function messages()
    {
        return [
            'id_pabrik.required' => 'mohon isikan id pabrik nya bro',
            'name.required' => 'mohon isikan nama nya bro',
            'detail.required' => 'mohon isikan detail nya bro',
            'price.required' => 'mohon isikan harga nya bro',
            'image.required' => 'mohon isikan gambar nya bro',
        ];
    }
}
