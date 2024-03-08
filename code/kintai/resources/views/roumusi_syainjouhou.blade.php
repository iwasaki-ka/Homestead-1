<x-layout title="社員情報">
    <div class="smalltitle">
        <h2>社員情報</h2>
        <div class="loginjouhou">
            <p>社員番号: {{ $syain_number }}  氏名: {{ session('user')->name }}</p>
        </div>
    </div>
    <table class="syainjouhou_table">
        <tr>
            <th>社員番号</th>
            <th>氏名</th>
            <th>所属</th>
            <th>ユーザータイプ</th>
        </tr>
        <tr>
            <td>{{ $syain->syain_number }}</td>
            <td>{{ $syain->name }}</td>
            <td>{{ $syain->syozoku }}</td>
            <td>{{ $syain->user_type }}</td>
        </tr>
    </table>

    <h3>勤務表</h3>
    <ul>
        @foreach ($months as $month)
        <h4><a href="{{ route('roumusi_kintai_detail', ['syain_number' => $syain->syain_number, 'year' => $month->year, 'month' => sprintf('%02d', $month->month)]) }}">{{ $month->year }}年{{ $month->month }}月</a></h4>
        @endforeach
        </ul>
    <form method="GET" action="{{ route('roumusi_search', ['syain_number' => $syain->syain_number]) }}">
        @csrf
        <button type="submit">戻る</button>
    </form>
</x-layout>
