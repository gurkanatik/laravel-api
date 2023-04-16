<?php

namespace App\Http\Requests\Contact;

use App\Models\UserContact;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class StoreContactRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'phone' => [
                'required',
                'regex:/^(05\d{9})$/',
                Rule::unique((new UserContact())->getTable())->where(function ($query) {
                    return $query->where('user_id', Auth::guard('api')->user()->id);
                }),
            ]
        ];
    }
}
