<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;


class PrintController extends Controller
{

    public function printAllegroTables(){
        $orders = Order::get();
        return view('old.print', ['orders' => $orders]);
    }




}
