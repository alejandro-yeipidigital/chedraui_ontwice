<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ParticipationUpdateRequest extends FormRequest
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
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'total'         => 'Monto Total',
            'folio'         => 'Folio',
            'store_id'      => 'Proveedor',
            'payment'       => 'Forma de Pago',
            'main_product'  => 'Producto Principal',
            'reason'        => 'Razón de Rechazo',
            'region'        => 'Región'
        ];
    }

    /**
     * 
     */
    public function messages()
    {
        return [
            'total.required_if'                 => "El Monto Total es obligatorio cuando Váldio es SI",
            'folio.required'                    => "EL Folio es obligatorio",
            'valido.required'                   => "El campo Válido es obligatorio",
            'store.required_if'                 => "El campo Tienda es obligatorio cuando Válido es SI",
            'payment.required_if'               => "La Forma de Pago es obligatorio cuando Válido es SI",
            'main_product.required_if'          => "El Producto Principal es obligatorio cuando Válido es SI",
            'reason.required_if'                => "La Razón de Rechazo es obligatorio cuando Válido es NO",
            'region.required'                   => "La región es requerida.",
            'region.exists'                     => "Seleccione un valor valido para región."
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'total'             => 'required_if:valido,2|numeric',
            'folio'             => 'required',
            'valido'            => 'required',
            'store'             => 'required_if:valido,2',
            'payment'           => 'required_if:valido,2',
            'main_product'      => 'required_if:valido,2',
            'other_products'    => 'nullable',
            'reason'            => 'required_if:valido,3',
            'region'            => 'required|exists:estados,estado'
        ];
    }
}
