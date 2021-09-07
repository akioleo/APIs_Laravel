<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\ProductRequest;
use App\Product;
use App\Repository\ProductRepository;
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
    //Injetar request pois irá receber dados da url
    public function index(Request $request)
    {
        $products = $this->product;
        //Passando uma instância do model para o repository
        $productRepository = new ProductRepository($products);

        if($request->has('conditions')) {
            $productRepository->selectCondition($request->get('conditions'));
        }

        if($request->has('fields')) {
            $productRepository->selectFilter($request->get('fields'));
        }

        return response()->json($productRepository->getResult()->paginate(10));
        //return new ProductCollection($products);
    }

    public function show($id)
    {
        $product = $this->product->find($id);
        //return response()->json($product);
        return new ProductResource($product);
    }


    //Como vai receber um dado, injetar request
    public function save(ProductRequest $request)
    {
        $data = $request->all();
        $product = $this->product->create($data);
        return response()->json($product);
    }

    public function update(ProductRequest $request)
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
