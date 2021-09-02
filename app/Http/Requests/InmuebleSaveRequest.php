<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InmuebleSaveRequest extends FormRequest
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
                //
                'nombrePublicacion'=>'required|min:6',
                'inmueble.descripcion'=>'required|min:20',
                'inmueble.direccion'=>'required|min:10',
                'inmueble.latitud'=>'required|numeric|min:-99.99|max:99.99',
                'inmueble.longitud'=>'required|numeric|min:-99.99|max:99.99',
                'inmueble.superficie_total'=>'required|numeric|min:0|max:99999.99',
                'inmueble.tipoinmueble_id'=>'required',
                'inmueble.superficie_cubierta'=>'nullable|numeric|min:0|max:9999.99',
                'inmueble.ambientes'=>'nullable|integer|min:0',
                'inmueble.dormitorios'=>'nullable|integer|min:0',
                'inmueble.banos'=>'nullable|integer|min:0',
                'inmueble.cantidad_pisos'=>'nullable|integer|min:0',
                'inmueble.pisos_unidad'=>'nullable|integer|min:0',
                'inmueble.departamentos_por_piso'=>'nullable|integer|min:0',
            ];
    }
}
