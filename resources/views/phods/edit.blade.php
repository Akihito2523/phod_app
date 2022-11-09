<x-app-layout>

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
                <label for="date">日時</label>
                <input type="date" id="date" name="date" autofocus required
                    value="{{ old('date', $phod->date) }}">
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
