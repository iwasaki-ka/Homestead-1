<x-layout title="勤務表詳細">
    <div class="smalltitle">
        <h2>勤務表詳細</h2>
        <div class="loginjouhou">
        <p>社員番号: {{ $syain_number }}</p>
       </div>
      </div>
    <table class="kintai-table">
        <tr>
            <td>出勤日</td>
            <td>出勤時間</td>
            <td>退勤時間</td>
            <td>休憩時間</td>
            <td>勤務時間</td>
        </tr>
    @foreach ($kintai_records as $record)
    <tr>
        <td>{{ $record->date }}</td>
        <td>{{ \Carbon\Carbon::parse($record->start_time)->format('H:i') }}</td>
        <td>{{ \Carbon\Carbon::parse($record->end_time)->format('H:i') }}</td>
        <td>1:00</td>
        @php
            $start_time = \Carbon\Carbon::parse($record->start_time);
            $end_time = \Carbon\Carbon::parse($record->end_time);
            $work_hours = $end_time->diffInMinutes($start_time) / 60 - 1;
            $hours = floor($work_hours);
            $minutes = ($work_hours - $hours) * 60;
        @endphp
        <td>{{ sprintf('%02d:%02d', $hours, $minutes) }}</td>
    </tr>
    @endforeach
    </table>
    <form method="GET" action="{{ route('syain', ['syain_number' => $syain_number]) }}">
        @csrf
        <button type="submit">戻る</button>
    </form>
</x-layout>
