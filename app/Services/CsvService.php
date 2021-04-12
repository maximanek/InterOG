<?php

namespace App\Services;
use App\Repositories\CsvRepository;
use Illuminate\Support\Facades\DB;


class CsvService
{
    /**
     * @var $csvRepository
     */
    protected $csvRepository;

    /**
     * PostService constructor
     *
     * @param CsvRepository $csvRepository
     */
    public function __construct(CsvRepository $csvRepository)
    {
        $this->csvRepository = $csvRepository;
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
                $result = $this->csvRepository->saveShop($data);
            }
        }
        return $result;
    }

    public function getShopData()
    {
        return $this->csvRepository->getShop();
    }

    public function saveAllegro($data)
    {
        $array_with_order = [];
        $array_with_product = [];
        while(!feof($data))
        {
            $line= fgets($data);
            $find = strstr($line, 'order');
            if($find!="")
            {
                $test = "";
                $char_array=str_split($line);
                $flag=false;
                foreach ($char_array as $char)
                {
                    if($char=='"'){
                        $flag = !$flag;
                    }
                    if(!($flag==true && $char==",")){
                        $test = $test.$char;
                    }
                }
                array_push($array_with_order, explode(",", $test));
            }
            $find = strstr($line, 'lineItem');
            if($find!="")
            {
                $find = explode("," , $find);
                array_push($array_with_product, $find);
            }
        }
        fclose($data);
        foreach($array_with_product as $row)
        {
            $result_one = $this->csvRepository->saveAllegroProduct($row);
        }
        foreach($array_with_order as $row)
        {
            $result_2 = $this->csvRepository->saveAllegroOrder($row);
        }
        return [
            'result_one' => $result_one,
            'result_2' => $result_2
        ];
    }

    public function getAllegro()
    {
        $allegroProductforMarcin = $this->csvRepository->getAllegro('1 ');
        $allegroProductforWiesiek = $this->csvRepository->getAllegro('2');
        $allegroProductforMichal = $this->csvRepository->getAllegro('3');
        $allegroProductforPaniTomaka = $this->csvRepository->getAllegro('4');
        $allegroProductforPaszczyna = $this->csvRepository->getAllegro('5');
        $allegroProductforZbigniew = $this->csvRepository->getAllegro('6');
        $allegroProductforAndrzej = $this->csvRepository->getAllegro('7');
        $allegroProductforElgarden = $this->csvRepository->getAllegro('8');
        $allegroProductforMirochna = $this->csvRepository->getAllegro('9');
        $allegroProductforTyper = $this->csvRepository->getAllegro('10');

        $data =[
            'table' =>[
            '0' => ['Marcin', $allegroProductforMarcin],
            '1' => ['Wiesiek', $allegroProductforWiesiek],
            '2' => ['Michal', $allegroProductforMichal],
            '3' => ['PaniTomaka', $allegroProductforPaniTomaka],
            '4' =>['Paszczyna', $allegroProductforPaszczyna],
            '5' => ['Zbigniew', $allegroProductforZbigniew],
            '6' => ['Andrzej', $allegroProductforAndrzej],
            '7' => ['Elgarden', $allegroProductforElgarden],
            '8' => ['Mirochna', $allegroProductforMirochna],
            '9' => ['Typer', $allegroProductforTyper],
        ]];
        return $data;
    }

    public function dropAllegro()
    {
        return $this->csvRepository->dropAllegro();
    }
}
