<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use App\Http\Requests\Request;

class TempatRequest extends FormRequest
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
            'nama_tempat' => 'required',
            'kategori_tempat' => 'required',
            'lang_tempat' => 'required',
            'lat_tempat' => 'required',
            'id_desa' => 'required',
        ];

        if (request()->isMethod('post')) {
            $rules['foto_tempat'] = 'required|image';
        }
        return $rules;
    }
    public function attributes()
    {
        return [
            'nama_tempat'            => 'nama tempat',
            'kategori_tempat'             => 'lategori tempat',
            'lat_tempat'             => 'latitidue',
            'lang_tempat'             => 'langitude',
            'foto_tempat'             => 'foto tempat',
            'id_desa'             => 'desa'
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
