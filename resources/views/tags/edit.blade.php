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
                <label for="type">タグ</label>
                <input type="text" id="type" name="type" autofocus required
                    value="{{ old('type', $tag->type) }}">
            </div>

            <input type="submit" class="submit" value="更新">
        </form>
    </div>

    <a href="{{ route('tags.index') }}" class="btn btn_blue">戻る</a>

</x-app-layout>
