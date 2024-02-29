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
    <input type="submit" value="出勤">
   </form>
   </div>
   @if($kintai && ($kintai->id || $kintai->end_time == "00:00:00"))
   <div class="dakoku_button">
   <form method="post" action="{{ route('dakoku.taikin', ['kintai' => $kintai->id]) }}">
    @csrf
    @method('PUT')
    <input type="submit" value="退勤">
   </form>
   </div>
   @endif
   <div>
    @if($kintai)
        @if($kintai->start_time != "00:00:00")
            <p>出勤時刻: {{ $kintai->start_time }}</p>
        @endif
        @if($kintai->end_time != "00:00:00")
            <p>退勤時刻: {{ $kintai->end_time }}</p>
        @endif
    @endif
</div>
   <form method="GET" action="{{ route('syain', ['syain_number' => $syain_number]) }}">
    @csrf
    <button type="submit">戻る</button>
</form>
</x-layout>

