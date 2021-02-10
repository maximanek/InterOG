<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable= [
        'OrderId',
        'SellerId',
        'SellerLogin',
        'OrderDate',
        'SellerStatus',
        'BuyerId',
        'BuyerLogin',
        'BuyerEmail',
        'BuyerCompany',
        'BuyerName',
        'BuyerPhone',
        'BuyerAddress',
        'BuyerZip',
        'BuyerCity',
        'BuyerCountryCode',
        'PaymentId',
        'PaymentStatus',
        'PaymentProvider',
        'PaymentAmount',
        'PaymentCurrency',
        'DeliveryMethod',
        'DeliveryAmount',
        'DeliveryCurrency',
        'DeliveryAddressCompanyName',
        'DeliveryAddressName',
        'DeliveryAddressPhone',
        'DeliveryAddressStreet',
        'DeliveryAddressZipCode',
        'DeliveryAddressCity',
        'DeliveryAddressCountry',
        'DeliveryPickupPointId',
        'DeliveryPickupPointName',
        'DeliveryPickupPointStreet',
        'DeliveryPickupPointZipCode',
        'DeliveryPickupPointCity',
        'InvoiceName',
        'InvoiceCompanyName',
        'InvoiceStreet',
        'InvoiceZipCode',
        'InvoiceCity',
        'InvoiceCountry',
        'InvoiceTaxId',
        'TotalToPayAmount',
        'TotalToPayCurrency',
        'TotalPaidAmount',
        'TotalPaidCurrency',
        'SellerNotes',
        'BuyerNotes',
    ];

    public function products()
    {
       return $this->hasMany(Product::class, 'OrderId', 'OrderId');
    }

}
