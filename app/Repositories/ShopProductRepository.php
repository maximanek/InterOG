<?php

namespace App\Repositories;

use App\Models\ShopProduct;

class ShopProductRepository
{
    /**
     * @var ShopProduct
     */
    protected $shopProduct;

    /**
     *  PostRepository constructor
     *
     * @param ShopProduct $shopProduct
     */
    public function __construct(ShopProduct $shopProduct)
    {
        $this->shopProduct = $shopProduct;
    }

    public function save($data)
    {
        $product = new $this->shopProduct;

        $product->date = now()->parse(str_replace('"','',$data['date']));
        $product->product_name = $data['product'];
        $product->quantity = $data['quantity'];

        $product->save();

    return $product->fresh();
    }
}
