<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VehiculoSaveRequest extends FormRequest
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
            'vehiculo.descripcion'=>'required|min:20',
            'vehiculo.direccion'=>'required|min:10',
            'vehiculo.ano'=>'required|digits:4',
            'vehiculo.color'=>'required|string',
            'vehiculo.latitud'=>'required|numeric|min:-99.99|max:99.99',
            'vehiculo.longitud'=>'required|numeric|min:-99.99|max:99.99',
            'vehiculo.tipo_combustible'=>'required',
            'vehiculo.puertas'=>'required|numeric',
            'vehiculo.transmision'=>'required',
            'vehiculo.motor'=>'required',
            'vehiculo.km'=>'required|numeric',
            'vehiculo.velocidades'=>'required|numeric',
            'vehiculo.capacidad_tanque'=>'nullable|numeric',
            'vehiculo.potencia'=>'nullable|numeric',
            'vehiculo.peso'=>'nullable|numeric',
            'vehiculo.capacidad_balde'=>'nullable|numeric',
            'vehiculo.capacidad_carga'=>'nullable|numeric',
            'vehiculo.capacidad_cuchara'=>'nullable|numeric',
            'vehiculo.horas_trabajadas'=>'nullable|numeric',
            'vehiculo.tipovehiculo_id'=>'required',
        ];
    }
}
