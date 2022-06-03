<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;


class BaseRegisterFormRequest extends FormRequest
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
            'email' => ['required', 'email:rfc'],
            'name' => ['required'],
            'password' => ['required'],
        ];
    }
    /**
     * Configure the validator instance.
     *
     * @param  Validator  $validator
     * @return void
     */
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $user = User::query()
                ->where('email', $this->validated('email'))
                ->whereNotNull('registered_at')
                ->first();
            if ($user !== null)
            {
                $validator->errors()->add('email', 'Email has already been registered');
            }
        });
    }
}
