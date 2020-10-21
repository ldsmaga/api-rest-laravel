<?php

namespace App\Http\Requests;

use App\Product;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Tymon\JWTAuth\Contracts\Providers\Auth;

class ProductRequest extends FormRequest
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
            'price' => 'required|numeric',
            'name' => 'required',
            'description' => 'required'
        ];
    }

     /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages()
    {
        return [
            'description.required' => 'Descrição é obrigatório',
            'name.required' => 'Nome é obrigatório',
            'price.required' => 'Preço é obrigatório',
            'price.numeric'=>'Preço deve ser um numérico'
        ];
    }

    //Função para formatar o nome do produto, para utilizar como URL amigável
    public function setSlug($name)
    {
        $propertySlug = Str::slug($name);

        $products = Product::where('name', $name)->first();

        $t = 0;

        foreach ($products as $product) {
            if (Str::slug($product->name) === $propertySlug) {
                $t++;
            }
        }

        if ($t > 0) {
            $propertySlug = $propertySlug . '-' . $t;
        }

        return $propertySlug;
    }
}
