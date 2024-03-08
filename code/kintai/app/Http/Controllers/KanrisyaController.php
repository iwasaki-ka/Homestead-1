<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Syain;
use App\Models\Kintai;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;


class KanrisyaController extends Controller
{

public function newsyain()
{
    $syain_number = auth()->user()->syain_number;
    $syain = Syain::where('syain_number', $syain_number)->first();
    return view('newsyain', ['syain' => $syain, 'syain_number' => $syain->syain_number]);
}

public function create_syain(Request $request)
{
    $rules = [
        'syain_number' => 'required|unique:syain,syain_number',
        'name' => 'required',
        'syozoku' => 'required',
        'user_type' => 'required',
    ];

    $messages = [
        'syain_number.required' => 'すべての項目を入力してください。',
        'syain_number.unique' => '既に存在する社員番号です。',
        'name.required' => 'すべての項目を入力してください。',
        'syozoku.required' => 'すべての項目を入力してください。',
        'user_type.required' => 'すべての項目を入力してください。',
    ];

    $request->validate($rules, $messages);

    $syain = new Syain;
    $syain->syain_number = $request->syain_number;
    $syain->name = $request->name;
    $syain->syozoku = $request->syozoku;
    $syain->user_type = $request->user_type;
    $syain->save();

    session()->flash('message', '登録しました');

    return redirect()->route('newsyain');
}

public function updateSyain(Request $request, $syain_number)
{

    $syain = Syain::where('syain_number', $syain_number)->first();

    DB::transaction(function () use ($request, $syain_number,$syain) {

        Schema::disableForeignKeyConstraints();

        $temp_syain_number = $syain_number . '_temp';

        DB::table('kintai')
            ->where('syain_number', $syain_number)
            ->update(['syain_number' => $temp_syain_number]);

        $syain->syain_number = $temp_syain_number;
        $syain->save();

        $request->validate([
            'syain_number' => 'required|unique:syain,syain_number,' . $syain->syain_number,
        ], [
            'syain_number.required' => '社員番号は必須です。',
            'syain_number.unique' => 'その社員番号は既に存在します。',
        ]);

        $syain->syain_number = $request->input('syain_number');
        $syain->save();

        DB::table('kintai')
            ->where('syain_number', $temp_syain_number)
            ->update(['syain_number' => $syain->syain_number]);

            Schema::enableForeignKeyConstraints();
    });

    return redirect()->route('syainjouhou', ['syain_number' => $syain->syain_number]);
}

}
?>
