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
                <tr class="tag_tag">
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
{{--  --}}
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
