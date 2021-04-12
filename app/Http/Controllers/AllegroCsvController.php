<?php

namespace App\Http\Controllers;

use App\Services\CsvService;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use Exception;
use App\Models\Product;
use phpDocumentor\Reflection\Types\Null_;
use Rap2hpoutre\FastExcel\FastExcel;
use Illuminate\Http\Request;
use Carbon\Carbon;


class AllegroCsvController extends Controller
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

    public function indexAllegro()
    {
        return view('old.allegro');
    }

    public function AllegroUpload(Request $request)
    {
        $data = fopen($request->AllegroFileInput,"r+" );
        $result = ['status' => 200];
        try {
            $result['data'] = $this->csvService->saveAllegro($data);
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }
        return redirect()->route('allegro.download');
    }

    public function AllegroGetData()
    {
        $data = $this->csvService->getAllegro();
        return view('old.allegro_table', $data);
    }
    public function AllegroDropTable()
    {
        $result = $this->csvService->dropAllegro();
        return view('old.allegro');
    }
}
