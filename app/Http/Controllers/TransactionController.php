<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaction;
use App\Product;

class TransactionController extends Controller
{
    public function store(Request $request)
    {
        $transaction = new Transaction();
        $transaction->customer_name = $request->customer_name;
        $transaction->total = $request->total;
        $transaction->save();

        $products = $this->createProducts($request, $transaction->id);

        $transaction->products()->attach($products);


        return response()->json([
            'error' => false,
            'message' => "Success"
        ]);
    }


    public function createProducts($request, $transaction_id)
    {
        $created_products = [];
        foreach ($request->products as $item) {
            $product = Product::where('id', $item['id'])->first();
            $new_product = [
                'transaction_id' => $transaction_id,
                'product_id' => $product->id,
                'harga' => $product->harga,
                'qty' => $item['qty'],
                'total' => $product->harga * $item['qty']
            ];
            array_push($created_products, $new_product);
        }

        return $created_products;
    }
}
