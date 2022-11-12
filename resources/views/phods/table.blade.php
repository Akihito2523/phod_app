<x-app-layout>

    <div class="form_header">
        <h2 class="headline">テーブル一覧</h2>
        {{-- 検索 --}}
        <form action="{{ route('table') }}" method="GET" class="form_position">
            @csrf
            <input type="search" name="title" placeholder="日付け" value="{{ old('title') }}">
            <input type="submit" value="検索" class="search">
        </form>
    </div>

    {{-- テーブル --}}
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
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
                    <td>{{ $phod->user->name }}</td>
                    <td>{{ $phod->title }}</td>
                    <td><img src="{{ $phod->image_url }}" class="table_img">{{ $phod->image }}</td>
                    {{-- <td>{{ date('Yd H:i:s', strtotime('-1 day')) $phod->created_at ?: '' }}{{ $phod->created_at }}
                    </td> --}}
                    <td>2022/11/03</td>

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
