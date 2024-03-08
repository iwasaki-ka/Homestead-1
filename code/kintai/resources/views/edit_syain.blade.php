<x-layout title="社員情報の編集">
    <div class="smalltitle">
        <h2>社員情報の編集</h2>
        <div class="loginjouhou">
            <p>社員番号: {{ $syain->syain_number }}  氏名: {{ session('user')->name }}</p>
       </div>
      </div>
    <form method="POST" action="{{ route('update_syain', ['syain_number' => $syain->syain_number]) }}">
        @csrf
        @method('PUT')

        <label for="syain_number">社員番号：</label>
        <input type="text" id="syain_number" name="syain_number" value="{{ $syain->syain_number }}">
        @error('syain_number')
            <div class="error">{{ $message }}</div>
        @enderror
        <label for="name">名前：</label>
        <input type="text" id="name" name="name" value="{{ $syain->name }}">
        <label for="syozoku">所属：</label>
        <br>
        <select id="syozoku" name="syozoku">
            <option value="大阪本社" {{ $syain->syozoku == '大阪本社' ? 'selected' : '' }}>大阪本社</option>
            <option value="名古屋支社" {{ $syain->syozoku == '名古屋支社' ? 'selected' : '' }}>名古屋支社</option>
            <option value="福岡支社" {{ $syain->syozoku == '福岡支社' ? 'selected' : '' }}>福岡支社</option>
            <option value="東京支社" {{ $syain->syozoku == '東京支社' ? 'selected' : '' }}>東京支社</option>
            <option value="労務士" {{ $syain->syozoku == '労務士' ? 'selected' : '' }}>労務士</option>
        </select>
        <br><br>
        <label for="user_type">ユーザータイプ：</label>
        <br>
        <select id="user_type" name="user_type">
            <option value="社員" {{ $syain->user_type == '社員' ? 'selected' : '' }}>社員</option>
            <option value="管理者" {{ $syain->user_type == '管理者' ? 'selected' : '' }}>管理者</option>
            <option value="労務士" {{ $syain->user_type == '労務士' ? 'selected' : '' }}>労務士</option>
        </select>
        <br>
        <button type="submit">更新</button>
    </form>
</x-layout>
