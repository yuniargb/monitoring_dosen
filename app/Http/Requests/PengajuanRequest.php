<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PengajuanRequest extends FormRequest
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
            'alamat' => 'required',
            'id_fakultas' => 'required',
            'id_prodi' => 'required',
            'nidn' => 'required|numeric',
        ];

        if (request()->isMethod('post')) {
            $rules['foto_1'] = 'required|image';
            $rules['foto_2'] = 'required|image';
            $rules['foto_3'] = 'required|image';
            $rules['foto_4'] = 'required|image';
        }
        return $rules;
    }
    public function attributes()
    {
        return [
            'nama'              => 'nama',
            'alamat'            => 'alamat',
            'id_fakultas'       => 'fakultas',
            'id_prodi'          => 'prodi',
            'nidn'              => 'nidn',
            
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
