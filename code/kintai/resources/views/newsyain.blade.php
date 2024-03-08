<x-layout title="社員情報の追加">
    <div class="smalltitle">
        <h2>社員情報の追加</h2>
        <div class="loginjouhou">
            <p>社員番号: {{ $syain_number }}  氏名: {{ session('user')->name }}</p>
        </div>
    </div>
     @if ($errors->any())
     <div class="error">
         <ul>
             @foreach ($errors->all() as $error)
                 <li>{{ $error }}</li>
             @endforeach
         </ul>
     </div>
 @endif


 @if (session('message'))
     <div class="alert alert-success">
         {{ session('message') }}
     </div>
 @endif

    <form method="POST" action="{{ route('create_syain') }}">
        @csrf
        <label for="syain_number">社員番号：</label>
        <input type="text" id="syain_number" name="syain_number">
        <label for="name">名前：</label>
        <input type="text" id="name" name="name">
        <label for="syozoku">所属：</label>
        <select id="syozoku" name="syozoku">
            <option value="大阪本社" {{ $syain->syozoku == '大阪本社' ? 'selected' : '' }}>大阪本社</option>
            <option value="名古屋支社" {{ $syain->syozoku == '名古屋支社' ? 'selected' : '' }}>名古屋支社</option>
            <option value="福岡支社" {{ $syain->syozoku == '福岡支社' ? 'selected' : '' }}>福岡支社</option>
            <option value="東京支社" {{ $syain->syozoku == '東京支社' ? 'selected' : '' }}>東京支社</option>
            <option value="労務士" {{ $syain->syozoku == '労務士' ? 'selected' : '' }}>労務士</option>
        </select>
        <br>
        <br>
        <label for="user_type">ユーザータイプ：</label>
        <select id="user_type" name="user_type">
            <option value="社員" {{ $syain->user_type == '社員' ? 'selected' : '' }}>社員</option>
            <option value="管理者" {{ $syain->user_type == '管理者' ? 'selected' : '' }}>管理者</option>
            <option value="労務士" {{ $syain->user_type == '労務士' ? 'selected' : '' }}>労務士</option>
        </select>
        <br>
        <button type="submit">追加</button>
    </form>
    <form method="GET" action="{{ route('kanrisya', ['syain_number' => $syain_number]) }}">
        @csrf
        <button type="submit">戻る</button>
    </form>
</x-layout>
