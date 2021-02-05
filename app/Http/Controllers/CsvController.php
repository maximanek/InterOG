<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\ShopProduct;
use App\Models\Order;
use App\Models\Product;
use phpDocumentor\Reflection\Types\Null_;
use Rap2hpoutre\FastExcel\FastExcel;
use Illuminate\Http\Request;
use Carbon\Carbon;


class CsvController extends Controller
{

    public function indexAllegro(){
        return view('old.allegro');
    }

    public function AllegroDropTable(){
        DB::table('orders')->truncate();
        DB::table('products')->truncate();
        return view('old.allegro');
    }

    public function AllegroUpload(Request $request){
        $file = fopen($request->AllegroFileInput, 'r+');
        $array_with_order = [];
        $array_with_product = [];
        while(!feof($file))
        {
                $line= fgets($file);
                $find = strstr($line, 'order');
                if($find!="")
                    array_push($array_with_order, $find);
                $find = strstr($line, 'lineItem');
                if($find!="")
                    array_push($array_with_product, $find);
        }
        fclose($file);
        $table_with_orders =[];
        $table_with_products =[];
        foreach ($array_with_order as $string) // tworzenie tablicy z wlasciwymi wartosciami
        {
            $test = "";
            $string=str_split($string);
            $flag=false;
            foreach ($string as $index=>$char)
            {

                if($char=='"'){
                    $flag = !$flag;
                }
                if(!($flag==true && $char==",")){
                    $test = $test.$char;
//                    unset($string[$index]);
                }

            }
            $new_string = explode(",", $test);

            array_push($table_with_orders, $new_string);
        }
        foreach ($array_with_product as $string)
        {
            $new_string = explode(",", $string);
            array_push($table_with_products, $new_string);
        }

        foreach($table_with_products as $row)
        {
            Product::create([
            'Type'=> $row[0],
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
        foreach($table_with_orders as $row)
        {

            Order::create([
                'Type'=> $row[0],
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

        return redirect()->route('allegro.download');
    }

    public function AllegroGetData(){
        $allegroProductforMarcin = DB::table('products')
            ->select('OfferExternalId', DB::raw('SUM(Quantity) as Quantity'))
            ->groupby('OfferExternalId')
            ->havingRaw('SUM(Quantity)')
            ->where('OfferExternalId','like','"1 %')
            ->get();
        foreach ($allegroProductforMarcin as $string)
        {
            $trans=['"1' => '', '"' =>''];
            $string->OfferExternalId = strtr($string->OfferExternalId, $trans);

        }
        $allegroProductforWiesiek = DB::table('products')
            ->select('OfferExternalId', DB::raw('SUM(Quantity) as Quantity'))
            ->groupby('OfferExternalId')
            ->havingRaw('SUM(Quantity)')
            ->where('OfferExternalId','like','"2%')
            ->get();
        foreach ($allegroProductforWiesiek as $string)
        {
            $trans=['"2' => '', '"' =>''];
            $string->OfferExternalId = strtr($string->OfferExternalId, $trans);

        }
        $allegroProductforMichal = DB::table('products')
            ->select('OfferExternalId', DB::raw('SUM(Quantity) as Quantity'))
            ->groupby('OfferExternalId')
            ->havingRaw('SUM(Quantity)')
            ->where('OfferExternalId','like','"3%')
            ->get();
        foreach ($allegroProductforMichal as $string)
        {
            $trans=['"3' => '', '"' =>''];
            $string->OfferExternalId = strtr($string->OfferExternalId, $trans);
        }
        $allegroProductforPaniTomaka = DB::table('products')
            ->select('OfferExternalId', DB::raw('SUM(Quantity) as Quantity'))
            ->groupby('OfferExternalId')
            ->havingRaw('SUM(Quantity)')
            ->where('OfferExternalId','like','"4%')
            ->get();
        foreach ($allegroProductforPaniTomaka as $string)
        {
            $trans=['"4' => '', '"' =>''];
            $string->OfferExternalId = strtr($string->OfferExternalId, $trans);
        }
        $allegroProductforPaszczyna = DB::table('products')
            ->select('OfferExternalId', DB::raw('SUM(Quantity) as Quantity'))
            ->groupby('OfferExternalId')
            ->havingRaw('SUM(Quantity)')
            ->where('OfferExternalId','like','"5%')
            ->get();
        foreach ($allegroProductforPaszczyna as $string)
        {
            $trans=['"5' => '', '"' =>''];
            $string->OfferExternalId = strtr($string->OfferExternalId, $trans);
        }
        $allegroProductforZbigniew = DB::table('products')
            ->select('OfferExternalId', DB::raw('SUM(Quantity) as Quantity'))
            ->groupby('OfferExternalId')
            ->havingRaw('SUM(Quantity)')
            ->where('OfferExternalId','like','"6%')
            ->get();
        foreach ($allegroProductforZbigniew as $string)
        {
            $trans=['"6' => '', '"' =>''];
            $string->OfferExternalId = strtr($string->OfferExternalId, $trans);

        }
        $allegroProductforAndrzej = DB::table('products')
            ->select('OfferExternalId', DB::raw('SUM(Quantity) as Quantity'))
            ->groupby('OfferExternalId')
            ->havingRaw('SUM(Quantity)')
            ->where('OfferExternalId','like','"7%')
            ->get();
        foreach ($allegroProductforAndrzej as $string)
        {
            $trans=['"7' => '', '"' =>''];
            $string->OfferExternalId = strtr($string->OfferExternalId, $trans);

        }
        $allegroProductforElgarden = DB::table('products')
            ->select('OfferExternalId', DB::raw('SUM(Quantity) as Quantity'))
            ->groupby('OfferExternalId')
            ->havingRaw('SUM(Quantity)')
            ->where('OfferExternalId','like','"8%')
            ->get();
        foreach ($allegroProductforElgarden as $string)
        {
            $trans=['"8' => '', '"' =>''];
            $string->OfferExternalId = strtr($string->OfferExternalId, $trans);

        }
        $allegroProductforMirochna = DB::table('products')
            ->select('OfferExternalId', DB::raw('SUM(Quantity) as Quantity'))
            ->groupby('OfferExternalId')
            ->havingRaw('SUM(Quantity)')
            ->where('OfferExternalId','like','"9%')
            ->get();
        foreach ($allegroProductforMirochna as $string)
        {
            $trans=['"9' => '', '"' =>''];
            $string->OfferExternalId = strtr($string->OfferExternalId, $trans);

        }
        $allegroProductforTyper = DB::table('products')
            ->select('OfferExternalId', DB::raw('SUM(Quantity) as Quantity'))
            ->groupby('OfferExternalId')
            ->havingRaw('SUM(Quantity)')
            ->where('OfferExternalId','like','"10%')
            ->get();
        foreach ($allegroProductforTyper as $string)
        {
            $trans=['"10' => '', '"' =>''];
            $string->OfferExternalId = strtr($string->OfferExternalId, $trans);

        }


        $data =[
            'Marcin' => $allegroProductforMarcin,
            'Wiesiek' => $allegroProductforWiesiek,
            'Michal' => $allegroProductforMichal,
            'PaniTomaka' => $allegroProductforPaniTomaka,
            'Paszczyna' => $allegroProductforPaszczyna,
            'Zbigniew' => $allegroProductforZbigniew,
            'Andrzej' => $allegroProductforAndrzej,
            'Elgarden' => $allegroProductforElgarden,
            'Mirochna' => $allegroProductforMirochna,
            'Typer' => $allegroProductforTyper,
        ];
        return view('old.allegro_table', $data);


    }

    public function indexShop(){
        return view('old.shop');
    }

    public function shopUpload(Request $request)
    {
        DB::table('shop_products')->truncate();
        $Shopdate=$request->ShopDate;
        $file = fopen($request->ShopFileInput,"r+" );
        $tablica=[];
        while(!feof($file))
        {
            $linia = fgets($file);
            array_push($tablica, $linia);
        }
        unset($tablica[0]);
        fclose($file); // zamykanie pliku

        $wiersz = [];
        $tabela= [];

        foreach ($tablica as $string)
        {
            $wiersz = explode(";", $string);
            array_push($tabela, $wiersz);
        }

        $rozmiar = count($tabela)-1;
        for ($i=0; $i <= $rozmiar ; $i++) {
            array_shift($tabela[$i]);
        }
        array_pop($tabela);

        $size_3 =count($tabela[0])-2;

        foreach($tabela as $row) //
        {
           for($i=1 ; $i < $size_3 ;$i+=2)
            {
                if($row[$i]=="")
                    break;
                $j=$i+1;
                ShopProduct::create([
                    'date' => now()->parse(str_replace('"','',$row[0])),
                    'product_name' => $row[$i],
                    'quantity' => $row[$j]
                ]);
            }
        }
        $data =[
            'shop_data' => $Shopdate,
        ];
       return redirect()->route('shop.download', $data);
    }

    public function shopGetData(Request $request) {
        $shopProduct = DB::table('shop_products')
            ->select('product_name', DB::raw('SUM(quantity) as quantity'))
            ->groupby('product_name')
            ->havingRaw('SUM(quantity)')
            ->where('date','<',$request->shop_data)
            ->get();
        $data =[
            'shop_products' => $shopProduct,
        ];
        return view('old.shop_table', $data);
    }
}
