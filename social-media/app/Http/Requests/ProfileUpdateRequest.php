<?php

namespace App\Http\Requests;

use App\Rules\CustomEmailValidation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class ProfileUpdateRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        $todayDate = date('m/d/Y');
        return [
            'editName' => 'required',
            'editEmail' => ['required', 'unique:users,email,' . Auth::user()->id,new CustomEmailValidation()],
            'editAddress' => 'required',
            'editPhoto' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'editDob' => 'required|date|before:' . $todayDate,
            'editPhone' => 'required|digits:11',
        ];
    }
}
