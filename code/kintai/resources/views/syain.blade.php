<x-layout title="社員用ページ">
    <div class="smalltitle">
     <h2>社員用ページ</h2>
     <div class="loginjouhou">
     <p>社員番号: {{ $syain_number }}  氏名: {{ session('user')->name }}</p>
    </div>
   </div>
    <ul>
      <li><a href="{{ route('dakoku', ['syain_number' => $syain_number]) }}">出勤・退勤登録</a></li>
      <li><a href="">勤務表</a></li>
    </ul>
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">ログアウト</button>
    </form>
</x-layout>


{{-- {{ route('kinmuhyou') }} --}}

