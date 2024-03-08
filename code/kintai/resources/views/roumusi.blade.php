<x-layout title="労務士用ページ">
    <div class="smalltitle">
        <h2>労務士用ページ</h2>
        <div class="loginjouhou">
            <p>社員番号: {{ $syain_number }}  氏名: {{ session('user')->name }}</p>
        </div>
    </div>
    <ul>
        <li><a href="{{ route('roumusi_search', ['syain_number' => $syain_number]) }}">社員検索</a></li>
    </ul>
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">ログアウト</button>
    </form>
</x-layout>
