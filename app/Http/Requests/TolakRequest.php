<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TolakRequest extends FormRequest
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
            'pesan_revisi' => 'required',
        ];

        
        return $rules;
    }
    public function attributes()
    {
        return [
            'status'              => 'status',
            'pesan_revisi'              => 'pesan'
        ];
    }
    public function messages()
    {
        return [
            'required' => ':attribute ini wajib diisi',
            'image' => ':attribute ini wajib gambar',
            'numeric' => ':attribute harus angka'
        ];
    }
}
