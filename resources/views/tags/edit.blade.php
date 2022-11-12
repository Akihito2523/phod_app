<x-app-layout>

    <h2 class="headline">編集</h2>

    {{-- validation-errors.blade.php読み込み --}}
    <x-validation-errors :errors="$errors" />

    <!-- フォーム -->
    <div class="wrapper formBackground">
        <form action="{{ route('tags.update', $tag) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div>
                <label for="tag">タグ</label>
                <input type="text" id="tag" name="tag" autofocus required
                    value="{{ old('tag', $tag->tag) }}">
            </div>

            <input type="submit" class="submit" value="更新">
        </form>
    </div>

    <a href="{{ route('tags.index') }}" class="btn btn_blue">戻る</a>

</x-app-layout>
