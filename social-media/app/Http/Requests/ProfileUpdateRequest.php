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
            'name' => 'required',
            'email' => ['required','unique:users,email,'.Auth::user()->id,new CustomEmailValidation()],
            'confirm_password' => 'required|same:password',
            'address' => 'required',
            // 'photo'=>'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'dob'=>'required|date|before:'.$todayDate,
            'phone' => 'required|digits:11',
        ];
    }
}
