<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Syain;
use App\Models\Kintai;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;


class SearchController extends Controller
{
    public function showResult(Request $request, $syain_number)
    {
        $syain_number = auth()->user()->syain_number;

        $syain_number_query = $request->input('syain_number');
    $name_query = $request->input('name');
    $syozoku_query = $request->input('syozoku');

    $results = Syain::query();

    if (!empty($syain_number_query)) {
        $results = $results->where('syain_number', 'like', '%' . $syain_number_query . '%');
    }

    if (!empty($name_query)) {
        $results = $results->where('name', 'like', '%' . $name_query . '%');
    }

    if (!empty($syozoku_query)) {
        $results = $results->where('syozoku', 'like', '%' . $syozoku_query . '%');
    }

    $results = $results->get();

    if (auth()->user()->isRoumusi()) {
        return view('roumusi_search_result', ['results' => $results, 'syain_number' => $syain_number]);
    } else {
        return view('search_result', ['results' => $results, 'syain_number' => $syain_number]);
    }
}


    public function showSearchPage(Request $request, $syain_number)
{

    $syozoku_list = Syain::select('syozoku')->distinct()->get();

    if (auth()->user()->isRoumusi()) {
        return view('roumusi_search', ['syozoku_list' => $syozoku_list, 'syain_number' => $syain_number]);
    } else {
        return view('search', ['syozoku_list' => $syozoku_list, 'syain_number' => $syain_number]);
    }
}

public function showSyainJouhou(Request $request, $syain_number)
{

    $syain = Syain::where('syain_number', $syain_number)->first();
    $months = Kintai::where('syain_number', $syain_number)
                    ->selectRaw('DISTINCT YEAR(date) as year, MONTH(date) as month')
                    ->get();
    if (auth()->user()->isRoumusi()) {
     return view('roumusi_syainjouhou', ['syain' => $syain, 'months' => $months, 'syain_number' => $syain_number]);
         } else {
    return view('syainjouhou', ['syain' => $syain, 'months' => $months, 'syain_number' => $syain_number]);
}
}

public function showKintaiDetail(Request $request, $syain_number, $year, $month)
{
    
    $date = $year . '-' . $month;

    $syain = Syain::where('syain_number', $syain_number)->first();
    $kintai_records = Kintai::where('syain_number', $syain_number)
    ->whereMonth('date', Carbon::parse($date)->month)
    ->get();
    if (auth()->user()->isRoumusi()) {
        return view('roumusi_kintai_detail', ['syain' => $syain, 'kintai_records' => $kintai_records, 'syain_number' => $syain_number]);
            } else {
return view('kintai_detail', ['syain' => $syain, 'kintai_records' => $kintai_records, 'syain_number' => $syain_number]);
}
}



public function editSyain($syain_number)
{

    $syain = Syain::where('syain_number', $syain_number)->first();

    return view('edit_syain', ['syain' => $syain]);
}




}
?>
