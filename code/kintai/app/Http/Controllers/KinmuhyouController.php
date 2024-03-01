<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kintai;
use App\Models\MonthKintai;

class KinmuhyouController extends Controller
{


    public function dakoku_view($syain_number)
{
    $kintai = Kintai::where('syain_number', $syain_number)->latest()->first();
    return view('dakoku', ['syain_number' => $syain_number, 'kintai' => $kintai]);
}

    public function showKintai($syain_number)
{
    $month_kintai_records = MonthKintai::where('syain_number', $syain_number)->orderBy('month', 'desc')->get();
    return view('kinmuhyou', ['syain_number' => $syain_number, 'month_kintai_records' => $month_kintai_records]);
}


public function kinmuhyou_detail($syain_number, $month)
{
    $kintai_records = Kintai::where('syain_number', $syain_number)->whereMonth('date', date('m', strtotime($month)))->get();
    return view('kinmuhyou_detail', ['syain_number' => $syain_number, 'month' => $month, 'kintai_records' => $kintai_records]);
}


}

?>
