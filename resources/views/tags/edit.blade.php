<x-app-layout>

<div class="header_nav">
        <h1><a href="{{ route('root') }}"><img src="{{ asset('images/logo.png') }}" alt="写真" class="logo"></a></h1>
        <nav>
            <ul class="main-nav">
                <li> <a href="{{ route('root') }}">HOME</li>
                <li><a href="{{ route('list') }}">List</a></li>
                <li><a href="{{ route('contact') }}">Contact</a></li>
                <li><a href="{{ route('tags.index') }}">Tag</a></li>
            </ul>
        </nav>
    </div>

    <h2 class="headline">編集</h2>

    {{-- validation-errors.blade.php読み込み --}}
    <x-validation-errors :errors="$errors" />

    <!-- フォーム -->
    <div class="wrapper formBackground">
        <form action="{{ route('tags.update', $tag) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div>
                <label for="type">タグ</label>
                <input type="text" id="type" name="type" autofocus required
                    value="{{ old('type', $tag->type) }}">
            </div>

            <input type="submit" class="submit" value="更新">
        </form>
    </div>

    <a href="{{ route('tags.index') }}" class="btn btn_blue">戻る</a>

</x-app-layout>
