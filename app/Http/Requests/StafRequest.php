<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StafRequest extends FormRequest
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
        $rules = [
            'nama' => 'required',
            'no_telp' => 'required|numeric',
            'id_fakultas' => 'required',
        ];

        if (request()->isMethod('post')) {
            $rules['username'] = 'required|unique:users,username';
            $rules['email']    = 'required|email|unique:users,email';
            $rules['password']    = 'required';
        }
        if (request()->isMethod('put')) {
            $rules['username'] = 'required';
            $rules['email']    = 'required|email';
        }
        return $rules;
    }
    public function attributes()
    {
        return [
            'nama'            => 'nama',
            'username'            => 'username',
            'email'            => 'email',
            'id_fakultas'            => 'fakultas',
            'no_telp'            => 'nomor telfon',
            'password'            => 'password'
        ];
    }
    public function messages()
    {
        return [
            'required' => ':attribute ini wajib diisi',
            'image' => ':attribute ini wajib gambar',
            'numeric' => ':attribute harus angka',
            'email' => ':attribute harus format email'
        ];
    }
}
