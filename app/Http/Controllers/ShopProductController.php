<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use App\Services\CsvService;
use Illuminate\Support\Facades\DB;

class ShopProductController extends Controller
{
    /**
     * @var CsvService
     */
    private $csvService;

    /**
     * ShopProductController constructor
     *
     * @param CsvService $csvService
     */
    public function __construct(CsvService $csvService)
    {
        $this->csvService = $csvService;
    }

    public function index()
    {
        return view('old.shop');
    }

    public function store(Request $request)
    {
       $data = fopen($request->ShopFileInput,"r+" );
       $result = ['status' => 200];
       try {
           $result['data'] = $this->csvService->saveShopProductData($data);
       } catch (Exception $e) {
           $result = [
               'status' => 500,
               'error' => $e->getMessage()
           ];
       }
        return redirect()->route('shop.download');
   }

    public function shopGetData()
    {
        $data = $this->csvService->getShopData();
        return view('old.shop_table', $data);
    }

}
