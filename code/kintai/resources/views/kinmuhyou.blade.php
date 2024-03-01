<x-layout title="勤務表">
    <div class="smalltitle">
        <h2>勤務表</h2>
        <div class="loginjouhou">
        <p>社員番号: {{ $syain_number }}  氏名: {{ session('user')->name }}</p>
       </div>
      </div>
    @foreach ($month_kintai_records as $record)
    <h3><a href="/kinmuhyou_detail/{{ $syain_number }}/{{ $record->month }}">{{ $record->month }}</a></h3>
    <table class="kintai-table">
        <tr>
            <td>合計勤務時間</td>
            <td>合計出勤日数</td>
        </tr>
        <tr>
            <td>{{ $record->total_work_hours }}</td>
            <td>{{ $record->total_work_days }}</td>
        </tr>
    </table>
    @endforeach
    <form method="GET" action="{{ route('syain', ['syain_number' => $syain_number]) }}">
        @csrf
        <button type="submit">戻る</button>
    </form>
</x-layout>
