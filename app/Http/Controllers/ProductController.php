<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    protected  $rules = [
        'price' => 'required|numeric',
        'name' => 'required',
        'description' => 'required',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::where('user', Auth::user()->id)->get();
        return response()->json(['products' => $products]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $productSlug = $this->setSlug($request->name);
        $validator = Validator::make($request->all(), $this->rules);

        if ($validator->fails()) {
            return response()->json(['response' => $validator->messages()], 400);
        }

        $request->merge([
            'slug' => $productSlug,
            'description' => $request->description,
            'user' => Auth::user()->id
        ]);

        return Product::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::where('id', $id)->first();

        if (Auth::user()->id == $product->user) {
            return response()->json(['response' => $product], 200);
        }

        return response()->json(['response' => 'error'], 401);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $productSlug = $this->setSlug($request->name);

        $validator = Validator::make($request->all(), $this->rules);

        $product = Product::find($id);

        if ($validator->fails()) {
            return response()->json(['response' => $validator->messages()], 400);
        } 
        elseif (Auth::user()->id == $product->user) {

            $product->name = $request->name;
            $product->slug = $productSlug;
            $product->price = $request->price;
            $product->description = $request->description;

            $product->save();
            
            return response()->json(['response' => $product], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::where('id', $id)->first();
        if (!empty($product)) {
            if (Auth::user()->id == $product->user) {
                Product::destroy($id);
                return response()->json(['response' => "Register deleted"], 200);
            } else {
                return response()->json(['response' => 'Unauthorized'], 401);
            }
        } else {
            return response()->json(['response' => 'Register not found'], 400);
        }
    }

    //Função para formatar o nome do produto, para utilizar como URL amigável
    private function setSlug($name)
    {
        $propertySlug = Str::slug($name);

        $products = Product::all();

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