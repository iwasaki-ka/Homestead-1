<x-layout title="出勤・退勤打刻ページ">
    <div class="smalltitle">
     <h2>出勤・退勤打刻ページ</h2>
     <div class="loginjouhou">
     <p>社員番号: {{ $syain_number }}  氏名: {{ session('user')->name }}</p>
    </div>
   </div>
   <div class="dakoku_button">
    <form method="post" action="{{ route('dakoku.syukkin') }}">
        @csrf
        <input type="hidden" name="syain_number" value="{{ $syain_number }}">
        <input type="submit" value="出勤" {{ $kintai && $kintai["day{$day}_start_time"] ? 'disabled' : '' }}>
    </form>
</div>
@if($kintai)
@if($kintai["day{$day}_start_time"] && ($kintai["day{$day}_end_time"] == null || $kintai["day{$day}_end_time"] == '1000-01-01 00:00:00'))
    <div class="dakoku_button">
        <form method="post" action="{{ route('dakoku.taikin', ['syain_number' => $syain_number]) }}">
            @csrf
            @method('PUT')
            <input type="submit" value="退勤" {{ $kintai["day{$day}_end_time"] != '1000-01-01 00:00:00' ? 'disabled' : '' }}>
        </form>
   </div>
   @endif
   <div>
    @if($kintai["day{$day}_start_time"] != "1000-01-01 00:00:00")
        <p>出勤時刻: {{ $kintai["day{$day}_start_time"] }}</p>
    @endif
    @if($kintai["day{$day}_end_time"] != "1000-01-01 00:00:00")
        <p>退勤時刻: {{ $kintai["day{$day}_end_time"] }}</p>
    @endif
@endif
</div>
<form method="GET" action="{{ route('syain', ['syain_number' => $syain_number]) }}">
    @csrf
    <button type="submit">戻る</button>
</form>
</x-layout>
