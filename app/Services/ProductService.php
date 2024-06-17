<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Facades\DB;


class ProductService
{
    public function __construct(private Product $product)
    {
        $this->product = new Product();
    }
    public function getProducts()
    {
        // get all Products
        return  $this->product->orderBy('created_at', 'desc')->get();
    }
    public function getProduct($id)
    {
        //show Product
        return  $this->product->find($id);
    }
    public function createProduct($data)
    {
        try {
            DB::beginTransaction();

            $created_product = $this->product->create($data);
            DB::commit();
            return ['error' => false, 'data' => $created_product];
        } catch (\Throwable $th) {
            DB::rollback();
            return ['error' => true, 'data' => $th->getMessage()];
        }
    }
    public function updateProduct($id, $data)
    {
        try {
            DB::beginTransaction();

            $product = $this->getProduct($id);
            if ($product == null) {
                return ['error' => true, 'data' => 'Product Not Found'];
            }
            $product->update($data);
            DB::commit();
            return ['error' => false, 'data' => $this->getProduct($id)];
        } catch (\Throwable $th) {
            DB::rollback();
            return ['error' => true, 'data' => $th->getMessage()];
        }
    }
    public function removeProduct($id)
    {
        $product = $this->getProduct($id);
        if ($product == null) {
            return false;
        }
        //delete product
        $this->product->findOrFail($id)->delete();
        return true;
    }
}
