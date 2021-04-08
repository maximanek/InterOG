<?php

namespace App\Http\Controllers;

use App\Repositories\ShopProductRepository;
use Illuminate\Http\Request;
use Exception;
use App\Services\ShopProductService;
use App\Models\ShopProduct;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;


class ShopProductController extends Controller
{
    /**
     * @var ShopProductService
     */
    private $shopProductService;

    /**
     * ShopProductController constructor
     *
     * @param ShopProductService $shopProductService
     */
    public function __construct(ShopProductService $shopProductService)
    {
        $this->shopProductService = $shopProductService;
    }




    public function index()
    {
        return view('old.shop');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $data = fopen($request->ShopFileInput,"r+" );
       $result = ['status' => 200];
       try {
           $result['data'] = $this->shopProductService->saveShopProductData($data);
       } catch (Exception $e) {
           $result = [
               'status' => 500,
               'error' => $e->getMessage()
           ];
       }
       return response()->json($result, $result['status']);
   }

   /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return Response
    */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
