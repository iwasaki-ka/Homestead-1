<x-layout title="管理者用ページ">
    <div class="smalltitle">
        <h2>管理者用ページ</h2>
        <div class="loginjouhou">
            <p>社員番号: {{ $syain_number }}  氏名: {{ session('user')->name }}</p>
        </div>
    </div>
    <ul>
        <li><a href="{{ route('search', ['syain_number' => $syain_number]) }}">社員検索</a></li>
        <li><a href="{{ route('newsyain', ['syain_number' => $syain_number]) }}">社員追加</a></li>
    </ul>
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">ログアウト</button>
    </form>
</x-layout>
