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

    <div class="form_header">
        <h2 class="headline">リスト一覧</h2>
        {{-- 検索 --}}
        <form action="{{ route('list') }}" method="GET" class="form_position">
            @csrf
            <input type="search" name="title" placeholder="タイトル" value="{{ old('title') }}">
            <input type="search" name="tag_id" placeholder="タグ番号">
            <input type="submit" value="検索" class="search">
        </form>
    </div>

    {{-- テーブル --}}
    <table class="table">
        <thead>
            <tr>
                <th>ID番号</th>
                <th>タグ情報</th>
                <th>登録者</th>
                <th>タイトル</th>
                <th>写真</th>
                <th>撮影日</th>
                <th></th>
                <th></th>
            </tr>
        </thead>

        <tbody>
            @foreach ($phods as $phod)
                <tr>
                    <td><a href="{{ route('phods.show', $phod) }}" class="hover-link">{{ $phod->id }}</a></td>
                    <td>{{ $phod->tag->type }}</td>
                    <td>{{ $phod->user->name }}</td>
                    <td>{{ $phod->title }}</td>
                    <td class="img_font"><img src="{{ $phod->image_url }}" class="table_img">{{ $phod->image }}</td>
                    <td>{{ \Carbon\Carbon::parse($phod->created_at)->format('Y:m:d') }}</td>

                    {{-- @can('update', $photo) --}}
                    <td><a href="{{ route('phods.edit', $phod) }}" class="btn width">編集</a></td>
                    {{-- @endcan --}}

                    {{-- @can('delete', $photo) --}}
                    <td>
                        <form action="{{ route('phods.destroy', $phod) }}" id="form_recipe" method="post">
                            @csrf
                            @method('DELETE')
                            <input type="submit" value="削除" id="btn" class="btn btn_red width">
                        </form>
                        {{-- @endcan --}}
                    </td>
                </tr>
            @endforeach
        </tbody>

    </table>

    {{-- ページネーションリンク --}}
    {{-- {{ $phods->links() }} --}}

    <script src="{{ asset('/js/index.js') }}"></script>

</x-app-layout>
