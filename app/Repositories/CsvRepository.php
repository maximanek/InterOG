<?php

namespace App\Repositories;

use App\Models\ShopProduct;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class CsvRepository
{
    /**
     * @var ShopProduct
     * @var Order
     * @var Product
     */
    protected $shopProduct;
    protected $order;
    protected $product;

    /**
     *  CsvRepository constructor
     *
     * @param ShopProduct $shopProduct
     * @param Order $order
     * @param Product $product
     */
    public function __construct(ShopProduct $shopProduct, Order $order, Product $product)
    {
        $this->shopProduct = $shopProduct;
        $this->order = $order;
        $this->product = $product;
    }

    public function saveShop($data)
    {
        $product = new $this->shopProduct;

        $product->date = now()->parse(str_replace('"','',$data['date']));
        $product->product_name = $data['product'];
        $product->quantity = $data['quantity'];

        $product->save();

    return $product->fresh();
    }

    public function getShop()
    {
        $shopProduct = DB::table('shop_products')
            ->select('product_name', DB::raw('SUM(quantity) as quantity'))
            ->groupby('product_name')
            ->get();
        return [
            'shop_products' => $shopProduct,
        ];
    }

    public function dropAllegro()
    {
        DB::table('orders')->truncate();
        DB::table('products')->truncate();
        return 0;
    }

    public function saveAllegroProduct($row)
    {
        return Product::create([
            'OrderId'=> $row[1],
            'LineItemId'=> $row[2],
            'OfferId'=> $row[3],
            'OfferExternalId'=> $row[4],
            'Name'=> $row[5],
            'Quantity'=> $row[6],
            'Price'=> $row[7],
            'Currency'=> $row[8]
        ]);
    }

    public function saveAllegroOrder($row)
    {
        return Order::create([
            'OrderId'=> $row[1],
            'SellerId'=> $row[2],
            'SellerLogin'=> $row[3],
            'OrderDate'=> now()->parse(str_replace('"','',$row[4])),
            'SellerStatus'=> $row[5],
            'BuyerId'=> $row[6],
            'BuyerLogin'=> $row[7],
            'BuyerEmail'=> $row[8],
            'BuyerCompany'=> $row[9],
            'BuyerName'=> $row[10],
            'BuyerPhone'=> $row[11],
            'BuyerAddress'=> $row[12],
            'BuyerZip'=> $row[13],
            'BuyerCity'=> $row[14],
            'BuyerCountryCode'=> $row[15],
            'PaymentId'=> $row[16],
            'PaymentStatus'=> $row[17],
            'PaymentProvider'=> $row[18],
            'PaymentAmount'=> floatval($row[19]),
            'PaymentCurrency'=> $row[20],
            'DeliveryMethod'=> $row[21],
            'DeliveryAmount'=> floatval($row[22]),
            'DeliveryCurrency'=> $row[23],
            'DeliveryAddressCompanyName'=> $row[24],
            'DeliveryAddressName'=> $row[25],
            'DeliveryAddressPhone'=> $row[26],
            'DeliveryAddressStreet'=> $row[27],
            'DeliveryAddressZipCode'=> $row[28],
            'DeliveryAddressCity'=> $row[29],
            'DeliveryAddressCountry'=> $row[30],
            'DeliveryPickupPointId'=> $row[31],
            'DeliveryPickupPointName'=> $row[32],
            'DeliveryPickupPointStreet'=> $row[33],
            'DeliveryPickupPointZipCode'=> $row[34],
            'DeliveryPickupPointCity'=> $row[35],
            'InvoiceName'=> $row[36],
            'InvoiceCompanyName'=> $row[37],
            'InvoiceStreet'=> $row[38],
            'InvoiceZipCode'=> $row[39],
            'InvoiceCity'=> $row[40],
            'InvoiceCountry'=> $row[41],
            'InvoiceTaxId'=> $row[42],
            'TotalToPayAmount'=> $row[43],
            'TotalToPayCurrency'=> $row[44],
            'TotalPaidAmount'=> $row[45],
            'TotalPaidCurrency'=> $row[46],
            'SellerNotes'=> $row[47],
            'BuyerNotes'=> $row[48],
        ]);

    }
    public function getAllegro($number)
    {
        $products = DB::table('products')
            ->select('OfferExternalId', DB::raw('SUM(Quantity) as Quantity'))
            ->groupby('OfferExternalId')
            ->where('OfferExternalId','like','"'.$number.'%')
            ->get();
        foreach ($products as $string)
        {
            $trans=['"'.$number.'' => '', '"' =>''];
            $string->OfferExternalId = strtr($string->OfferExternalId, $trans);
        }
        return $products;
    }
}
