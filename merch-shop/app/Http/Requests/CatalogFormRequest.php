<?php

namespace App\Http\Requests;

use App\Enums\ProductSortType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CatalogFormRequest extends FormRequest
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
            'search_query' => ['nullable', 'string'],
            'sort_mode' => ['nullable', Rule::in(['price_asc', 'price_desc']), 'string'],
            'filters' => ['nullable', 'array'],
            'filters.*' => ['required', 'array']
        ];
    }
}
