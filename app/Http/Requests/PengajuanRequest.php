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
            'jabatan_fungsional' => 'required',
            'nidn' => 'required|numeric',
        ];

        if (request()->isMethod('post')) {
        
            $rules['bidang_a.*'] = 'required|mimes:doc,docx,pdf';
            $rules['bidang_b.*'] = 'required|mimes:doc,docx,pdf';
            $rules['bidang_c.*'] = 'required|mimes:doc,docx,pdf';
            $rules['bidang_d.*'] = 'required|mimes:doc,docx,pdf';
            $rules['lainnya.*'] = 'required|mimes:doc,docx,pdf';
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
            'jabatan_fungsional'              => 'jabatan fungsional',
            'bidan_a'              => 'bidang a',
            'bidang_b'              => 'bidang b',
            'bidang_c'              => 'bidang c',
            'bidang_d'              => 'bidang d',
            'lainnya'              => 'bidang lainnya',
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
