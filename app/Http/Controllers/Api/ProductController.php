<?php

namespace App\Http\Controllers\Api;

use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    private $product;
    //Model Product - Data private $products 
    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function index()
    {
        $products = $this->product->paginate(1);
        //return response()->json($products);
        return new ProductCollection($products);
    }

    public function show($id)
    {
        $product = $this->product->find($id);
        //return response()->json($product);
        return new ProductResource($product);
    }


    //Como vai receber um dado, injetar request
    public function save(Request $request)
    {
        $data = $request->all();
        $product = $this->product->create($data);
        return response()->json($product);
    }

    public function update(Request $request)
    {
        //Armazenar em $data os dados do request
        $data = $request -> all();
        //Buscando o product direto do Data (id)
        $product = $this->product->find($data['id']);
        $product->update($data);
        return response()->json($product);
    }

    public function delete($id)
    {
        $product = $this -> product ->find($id);
        $product->delete();

        return response()->json(['data' => ['msg' => 'Produto foi removido com sucesso!']]);
    }
}
