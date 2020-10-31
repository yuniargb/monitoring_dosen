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
        $rules = [];
        if (request()->isMethod('post')) {
        
            $rules['basenat.*'] = 'required|mimes:doc,docx,pdf';
        }
        return $rules;
    }
    public function attributes()
    {
        return [
            'basnat'              => 'BA SENAT',
            
        ];
    }
    public function messages()
    {
        return [
            'required' => ':attribute ini wajib diisi',
            'image' => ':attribute ini wajib gambar',
            'numeric' => ':attribute harus angka',
            'mimes' => ':attribute harus berupa doc,docx,pdf',
            'min' => ':attribute minimal 4'
        ];
    }
}
