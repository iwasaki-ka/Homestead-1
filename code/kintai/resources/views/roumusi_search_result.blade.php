<x-layout title="検索結果">
    <div class="smalltitle">
        <h2>検索結果</h2>
        <div class="loginjouhou">
            <p>社員番号: {{ $syain_number }}  氏名: {{ session('user')->name }}</p>
        </div>
    </div>
    @if ($results->isEmpty())
        <p>該当する社員は見つかりませんでした。</p>
    @else
    <ul>
        @foreach ($results as $result)
            <li>
                <a href="{{ route('roumusi_syainjouhou', ['syain_number' => $result->syain_number]) }}">
                    {{ $result->syain_number }}: {{ $result->name }}
                </a>
            </li>
        @endforeach
        </ul>
    @endif
    <form method="GET" action="{{ route('roumusi_search', ['syain_number' => $syain_number]) }}">
        @csrf
        <button type="submit">戻る</button>
    </form>
</x-layout>
