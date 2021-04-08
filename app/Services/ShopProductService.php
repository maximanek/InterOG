<?php

namespace App\Services;

use App\Models\ShopProduct;
use App\Repositories\ShopProductRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;

class ShopProductService
{
    /**
     * @var $shopProductRepository
     */
    protected $shopProductRepository;

    /**
     * PostService constructor
     *
     * @param ShopProductRepository $shopProductRepository
     */
    public function __construct(ShopProductRepository $shopProductRepository)
    {
        $this->shopProductRepository = $shopProductRepository;
    }


    public function saveShopProductData($data)
    {
        DB::table('shop_products')->truncate();
        $table= [];
        while(!feof($data))
        {
            $line = fgets($data);
            $row = explode(";", $line);
            array_shift($row);
            array_push($table, $row);

        }
        unset($table[0]);
        array_pop($table);

        foreach($table as $row)
        {
            for($i=1 ; $i < count($table[1])-2 ;$i+=2)
            {
                if($row[$i]=="")
                    break;
                $j=$i+1;
                $data = [
                  'date'   => $row[0],
                  'product' =>$row[$i],
                  'quantity' =>$row[$j],
                ];
                $result = $this->shopProductRepository->save($data);
            }
        }

        return $result;
    }




}
