<x-layout title="勤務記録変更">
    <div class="smalltitle">
        <h2>勤務記録変更</h2>
        <div class="loginjouhou">
            <p>社員番号: {{ $kintai ? $kintai->syain_number : $syain_number }}  氏名: {{ session('user')->name }}</p>
        </div>
    </div>
    <form method="POST" action="{{ route('update_kintai', ['syain_number' => $syain_number, 'date' => $date]) }}">
        @csrf
        @method('PUT')
        <label for="start_time">出勤時間:</label>
        <input type="time" id="start_time" name="start_time" value="{{ isset($start_time) ? \Carbon\Carbon::parse($start_time)->format('H:i') : '' }}">
        <label for="end_time">退勤時間:</label>
        <input type="time" id="end_time" name="end_time" value="{{ isset($end_time) ? \Carbon\Carbon::parse($end_time)->format('H:i') : '' }}">
        <label for="break_time">休憩時間（分）:</label>
        <input type="number" id="break_time" name="break_time" value="{{ isset($break_time) ? $break_time : '' }}">

        <button type="submit">更新</button>
    </form>
</x-layout>
