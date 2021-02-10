<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'OrderId',
        'LineItemId',
        'OfferId',
        'OfferExternalId',
        'Name',
        'Quantity',
        'Price',
        'Currency'
    ];

    public function order(){
       return $this->belongsTo(Order::class);
    }



}
