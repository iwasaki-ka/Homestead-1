<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kintai;
use Illuminate\Support\Facades\Auth;

class DakokuController extends Controller
{
    public function dakoku_view($syain_number)
{
    $kintai = Kintai::where('syain_number', $syain_number)->latest()->first();
    return view('dakoku', ['syain_number' => $syain_number, 'kintai' => $kintai]);
}

public function syukkin(Request $request)
{
    // 社員番号がnullでないことを確認
    if ($request->syain_number) {
        // 今月のレコードを取得または作成
        $kintai = Kintai::create([
            'syain_number' => $request->syain_number,
            'start_time' => now()->format('Y-m-d H:i:s'),
            'end_time' => '0000-00-00 00:00:00',
            'date' => now()->format('Y-m-d'),
        ]);
        return redirect()->route('dakoku', ['syain_number' => $request->syain_number]);
    } else {
        // 適切なエラーメッセージを表示
        return redirect()->back()->withErrors(['message' => '社員番号が存在しません。']);
    }
}




public function taikin(Request $request, $kintai_id)
{
    // 今月のレコードを取得
    $kintai = Kintai::find($kintai_id);
    if ($kintai) {
        // 退勤時間を追加
        $kintai->end_time = now()->format('Y-m-d H:i:s');
        $kintai->save();

        return redirect()->route('dakoku', ['syain_number' => $kintai->syain_number]);
    } else {
        // 適切なエラーメッセージを表示
        return redirect()->back()->withErrors(['message' => '出勤記録が存在しません。先に出勤を登録してください。']);
}

}
}
