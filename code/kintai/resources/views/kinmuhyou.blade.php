<x-layout title="勤務表">
    <div class="smalltitle">
        <h2>勤務表</h2>
        <div class="loginjouhou">
        <p>社員番号: {{ $syain_number }}  氏名: {{ session('user')->name }}</p>
       </div>
      </div>
      @foreach ($months as $month)
      <h3><a href="{{ route('kinmuhyou_detail', ['syain_number' => $syain_number, 'month' => $month->month]) }}">{{ $month->month }}</a></h3>
      @endforeach
    <form method="GET" action="{{ route('syain', ['syain_number' => $syain_number]) }}">
        @csrf
        <button type="submit">戻る</button>
    </form>
</x-layout>
