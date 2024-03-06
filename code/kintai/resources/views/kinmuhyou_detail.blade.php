<x-layout title="勤務表詳細">
    <div class="smalltitle">
        <h2>勤務表詳細</h2>
        <div class="loginjouhou">
            <p>社員番号: {{ $syain_number }}  氏名: {{ session('user')->name }}</p>
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
        @for ($day = 1; $day <= 31; $day++)
        @php
        $day = sprintf('%02d', $day);
    @endphp
            <tr>
                <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d', $record->date)->startOfMonth()->addDays($day - 1)->format('Y-m-d') }}</td>
                <td>{{ isset($record["day{$day}_start_time"]) ? \Carbon\Carbon::parse($record["day{$day}_start_time"])->format('H:i') : '' }}</td>
                <td>{{ isset($record["day{$day}_end_time"]) ? \Carbon\Carbon::parse($record["day{$day}_end_time"])->format('H:i') : '' }}</td>
                @php
                    $start_time = isset($record["day{$day}_start_time"]) ? \Carbon\Carbon::parse($record["day{$day}_start_time"]) : null;
                    $end_time = isset($record["day{$day}_end_time"]) ? \Carbon\Carbon::parse($record["day{$day}_end_time"]) : null;
                    $break_time = $record["day{$day}_break_time"] / 60;
                    $work_hours = $end_time ? $end_time->diffInMinutes($start_time) / 60 - $break_time : 0;
                    $hours = floor($work_hours);
                    $minutes = ($work_hours - $hours) * 60;
                @endphp
                <td>{{ sprintf('%02d:%02d', floor($record["day{$day}_break_time"] / 60), $record["day{$day}_break_time"] % 60) }}</td>
                <td>{{ sprintf('%02d:%02d', $hours, $minutes) }}</td>
                <td><a href="{{ route('edit_kintai', ['syain_number' => $syain_number, 'date' => \Carbon\Carbon::createFromFormat('Y-m-d', $record->date)->startOfMonth()->addDays($day - 1)->format('Y-m-d')]) }}">変更</a></td>
            </tr>
        @endfor
    @endforeach
    </table>
    <form method="GET" action="{{ route('syain', ['syain_number' => $syain_number]) }}">
        @csrf
        <button type="submit">戻る</button>
    </form>
</x-layout>
