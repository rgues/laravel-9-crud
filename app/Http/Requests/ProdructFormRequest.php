<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProdructFormRequest extends FormRequest
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

        $rules = [
            'name' => 'required|max:255|unique:products,name,' . $this->id,
            'price' => 'required',
            'description' => 'required',
            'image_path'=> ['max:2048'] // 'mimes:jpeg,png,jpg',
        ];

        if (in_array($this->method(),['POST'])) {
            $rules['image_path'] = ['required','max:2048'];
        }

        return $rules;
        
    }
}
