<x-layout title="労務士用 検索ページ">
    <div class="smalltitle">
        <h2>労務士用 検索ページ</h2>
        <div class="loginjouhou">
            <p>社員番号: {{ $syain_number }}  氏名: {{ session('user')->name }}</p>
        </div>
    </div>
    <form method="GET" action="{{ route('roumusi_search_result', ['syain_number' => $syain_number]) }}">
        @csrf
        <label for="syain_number">社員番号：</label>
        <input type="text" id="syain_number" name="syain_number">
        <label for="name">名前：</label>
        <input type="text" id="name" name="name">
        <label for="syozoku">所属：</label>
        <select id="syozoku" name="syozoku">
            <option value="">選択してください</option>
            @foreach ($syozoku_list as $syozoku)
                <option value="{{ $syozoku->syozoku }}">{{ $syozoku->syozoku }}</option>
            @endforeach
        </select>
        <br><button type="submit">検索</button>
    </form>
    <form method="GET" action="{{ route('roumusi', ['syain_number' => $syain_number]) }}">
        @csrf
        <button type="submit">戻る</button>
    </form>
</x-layout>
