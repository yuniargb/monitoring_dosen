<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReviewRequest extends FormRequest
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
        if (request()->isMethod('put')) {
            $rules['foto_1_r'] = 'required|image';
            $rules['foto_2_r'] = 'required|image';
            $rules['foto_3_r'] = 'required|image';
            $rules['foto_4_r'] = 'required|image';
            $rules['foto_5_r'] = 'required|image';
            $rules['foto_6_r'] = 'required|image';
            $rules['foto_7_r'] = 'required|image';
            $rules['foto_8_r'] = 'required|image';
            $rules['foto_9_r'] = 'required|image';
            $rules['foto_10_r'] = 'required|image';
        }
        return $rules;
    }
    public function attributes()
    {
        return [
            'foto_1_r'              => 'foto 1',
            'foto_2_r'              => 'foto 2',
            'foto_3_r'              => 'foto 3',
            'foto_4_r'              => 'foto 4',
            'foto_5_r'              => 'foto 5',
            'foto_6_r'              => 'foto 6',
            'foto_7_r'              => 'foto 7',
            'foto_8_r'              => 'foto 8',
            'foto_9_r'              => 'foto 9',
            'foto_10_r'              => 'foto 10',
            
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
