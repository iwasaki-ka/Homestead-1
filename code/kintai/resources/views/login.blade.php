<?php
$title = 'ログインページ';
?>

<x-layout :title="$title">
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div>
            <label for="syain_number">社員番号</label>
            <input id="syain_number" type="text" name="syain_number" value="{{ old('syain_number') }}" required autofocus>

            @if ($errors->has('syain_number'))
                <span class="error">{{ $errors->first('syain_number') }}</span>
            @endif
        </div>

        <div>
            <button type="submit">ログイン</button>
        </div>
    </form>
</x-layout>

