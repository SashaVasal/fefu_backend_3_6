<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CartModificationRequest extends FormRequest
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
            'modifications' => ['required', 'array', 'min:1'],
            'modifications.*.product_id' => ['required', 'int', 'exists:products,id'],
            'modifications.*.quantity' => ['required', 'int', 'min:0', 'max:99'],
        ];
    }

    public function validated($key = null, $default = null)
    {
        $data = parent::validated($key, $default);
        if ($data !== null) {
            $modificationsData = ($key === null ? $data['modifications'] : $data) ?? [];
            $resultModificationsDataByProductId = [];
            foreach ($modificationsData as $modificationsItem) {
                $productId = (int)$modificationsItem['product_id'];
                $resultModificationsDataByProductId[$productId] = [
                    'product_id' => $productId,
                    'quantity' => (int)$modificationsItem['quantity'],
                ];
            }
            $resultModificationsData = array_values($resultModificationsDataByProductId);
            if ($key === null) {
                $data = array_merge($data, ['modifications' => $resultModificationsData]);
            } else {
                $data = $resultModificationsData;
            }
        }
        return $data;
    }
}
