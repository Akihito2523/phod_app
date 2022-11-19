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
        <form action="{{ route('phods.update', $phod) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div>
                <label for="title">タイトル</label>
                <input type="text" id="title" name="title" autofocus required
                    value="{{ old('title', $phod->title) }}">
            </div>

            <div>
                <label for="place">場所</label>
                <input type="text" id="place" name="place" autofocus required
                    value="{{ old('place', $phod->place) }}">
            </div>

            <div>
                <label for="created_at">日時</label>
                <input type="date" id="created_at" name="created_at" autofocus required
                    value="{{ old('created_at', $phod->created_at) }}">
            </div>

            <div>
                <label for="body">コメント</label>
                <textarea name="body" class="body" id="body">{{ old('body', $phod->body) }}</textarea>
            </div>

            <div>
                <label for="image">写真変更</label>
                <img src="{{ $phod->image_url }}" alt="" class="edit_image">
                <input type="file" id="image" name="image">
            </div>

            <input type="submit" class="submit" value="更新">
        </form>
    </div>

    <a href="{{ route('phods.index') }}" class="btn btn_blue">戻る</a>

</x-app-layout>
