<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kintai;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class DakokuController extends Controller
{
    public function dakoku_view($syain_number)
{
    $kintai = Kintai::where('syain_number', $syain_number)->latest()->first();
    $day = sprintf('%02d', date('j'));
    return view('dakoku', ['syain_number' => $syain_number, 'kintai' => $kintai, 'day' => $day]);
}

    public function syukkin(Request $request)
    {
        $day = sprintf('%02d', date('j'));
        $kintai = Kintai::where('syain_number', $request->syain_number)
                        ->where('date', date('Y-m-d'))
                        ->first();
                        if (!$kintai) {
                            $kintai = new Kintai;
                            $kintai->syain_number = $request->syain_number;
                            $kintai->date = date('Y-m-d');
                            for ($i = 1; $i <= 31; $i++) {
                                $day_i = sprintf('%02d', $i);
                                $kintai["day{$day_i}_start_time"] = '1000-01-01 00:00:00';
                                $kintai["day{$day_i}_end_time"] = '1000-01-01 00:00:00';
                            }
                        }

        if ($kintai["day{$day}_start_time"] == '1000-01-01 00:00:00') {
            $kintai["day{$day}_start_time"] = date('Y-m-d H:i:s');
            $kintai->save();
        }

        return redirect()->route('dakoku', ['syain_number' => $request->syain_number]);
    }


    public function taikin(Request $request, $syain_number)
    {
        $day = sprintf('%02d', date('j'));
        $kintai = Kintai::where('syain_number', $syain_number)
                         ->where('date', date('Y-m-d'))
                         ->first();
        if ($kintai) {

            if ($kintai["day{$day}_end_time"] == '1000-01-01 00:00:00') {
                $kintai["day{$day}_end_time"] = date('Y-m-d H:i:s');
                $kintai["day{$day}_break_time"] = 60;
                $kintai->save();
            }

            return redirect()->route('dakoku', ['syain_number' => $kintai->syain_number]);
        } else {
            return redirect()->back()->withErrors(['message' => '出勤記録が存在しません。先に出勤を登録してください。']);
        }
    }
}
