<?php

namespace App\Http\Requests\Restaurant;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'=>'required|string',
            'phone'=>'required|string|unique:restaurants',
            'email'=>'required|email|unique:restaurants',
            'neighborhood_id'=>'required|integer',
            'password'=>'required|string|confirmed',
            'minimum_order'=>'required',
            'delivery_fees'=>'required',
            'contact_phone'=>'required|string',
            'contact_whatsapp'=>'required|string',
            'image'=>'required|file|mimes:png,jpg,jpeg,gif,svg,ico',
            'overall_rate'=>'nullable|integer',
            'is_active'=>'required|boolean',
            'categories'=>'required|array',
            'categories.*'=>'exists:categories,id'
        ];
    }
}
