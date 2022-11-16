<x-app-layout>

    <h2 class="headline">タグ一覧</h2>

    {{-- フラッシュメッセージ --}}
    <x-flash-message :message="session('notice')" />

    {{-- テーブル --}}
    <table class="table tags_table">
        {{-- <thead>
            <tr>
                <th>ID</th>
                <th>登録者</th>
                <th>タイトル</th>
                <th>写真</th>
                <th>撮影日</th>
                <th></th>
                <th></th>
            </tr>
        </thead> --}}

        <tbody>
            @foreach ($tags as $tag)
                <tr>
                    <td>{{ $tag->type }}</td>
                    {{-- @can('update', $tag) --}}
                        <td><a href="{{ route('tags.edit', $tag) }}" class="btn width">編集</a></td>
                    {{-- @endcan --}}

                    {{-- @can('delete', $tag) --}}
                        <td>
                            <form action="{{ route('tags.destroy', $tag) }}" id="form_recipe" method="post">
                                @csrf
                                @method('DELETE')
                                <input type="submit" value="削除" id="btn" class="btn btn_red width">
                            </form>
                        </td>
                    {{-- @endcan --}}

                </tr>
            @endforeach
        </tbody>

    </table>


    <h2 class="headline">タグ新規作成</h2>
    <div class="wrapper formBackground">
        <form action="{{ route('tags.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div>
                <label for="type">タグ</label>
                <input type="text" id="type" name="type" autofocus required value="{{ old('type') }}">
            </div>
            <input type="submit" class="submit" value="追加">
        </form>
    </div>

    <script src="{{ asset('/js/index.js') }}"></script>

</x-app-layout>
