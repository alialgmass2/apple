<?php

namespace App\Http\Requests\checkouts;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // dd('#HERE# ',request()->all());
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
            'type' => 'required|in:home,organization',
            'fname' => 'required|string|min:3|max:100',
            'lname' => 'required|string|min:3|max:100',
            // 'address' => 'required_if:type,==,home|min:3|max:100|string',
            'address' => 'required_if:type,home|min:3|max:100|string',
            // 'short_national_id' => 'required|string|min:3|max:100',
            'short_national_id' => 'required_if:type,home',
            // 'state' => 'required|integer|exists:regions,id',
            'state' => 'required_if:type,home',
            // 'city' => 'required|integer|exists:cities,id',
            'city' => 'required_if:type,home',
            // 'distracts' => 'required|string|min:3|max:100',
            'distracts' => 'required_if:type,home',
            // 'zip' => 'required|string|min:3|max:100',
            'zip' => 'required_if:type,home',
            //  'email' => 'required|email',
            'phone' => 'required|numeric',
            // 'payment_option'=>'required|in:cash,card',
            // 'methods' => 'required_if:payment_option,==,card|in:VISA,MASTER,MADA',
            'methods' => 'required|string|in:VISA,MASTER,MADA,cash,tabby',
            // 'card_number' => 'required_unless:methods,cash',
            // 'expiryMonth' => 'required_unless:methods,cash|integer|min:1|max:12',
            // 'expiryYear' => 'required_unless:methods,cash|integer|min:2024|max:2034',
            // 'card_number' => 'required_unless:methods,cash',
            // 'expiryMonth' => 'required_unless:methods,cash',
            // 'expiryYear' => 'required_unless:methods,cash',
            // 'cvv' => 'required_unless:methods,cash',
            // 'holder_name' => 'required_unless:methods,cash',
            // 'card_number'=>'required_if:payment_option,==,card',
            // 'expiryMonth'=>'required_if:payment_option,==,card',
            // 'expiryYear'=>'required_if:payment_option,==,card',
            // 'cvv'=>'required_if:payment_option,==,card',
            // 'holder_name'=>'required_if:payment_option,==,card'

        ];
    }
}
