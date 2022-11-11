<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TokoRequest extends FormRequest
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
            'id_user' => 'required',
            'name'      => 'required',
            'address'  => 'required',
            'phone'  => 'required',
            'image'  => 'required',
            'status'  => 'required',
        ];
    }

    public function messages()
    {
        return [
            'id_user.required' => 'mohon isikan id pabrik nya bro',
            'name.required' => 'mohon isikan nama nya bro',
            'address.required' => 'mohon isikan alamat nya bro',
            'phone.required' => 'mohon isikan nomer telpon nya bro',
            'image.required' => 'mohon isikan gambar nya bro',
            'status.required' => 'mohon isikan status nya bro',
        ];
    }
}
