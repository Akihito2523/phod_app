<x-app-layout>

    {{-- flash-message.blade.php読み込み --}}
    {{-- フラッシュメッセージ --}}
    <x-flash-message :message="session('notice')" />

    <div class="form_header">
        <h2 class="headline">写真一覧</h2>
        {{-- 検索 --}}
        <form action="{{ route('phods.index') }}" method="GET" class="form_position">
            @csrf
            <input type="search" name="title" placeholder="タイトル" value="{{ old('title') }}">
            <input type="search" name="tag_id" placeholder="タグ番号">
            <input type="submit" value="検索" class="search">
        </form>
    </div>


    <section class="gallery" id="gallery">

        <div class="gallery_list">
            <ul class="list_nav_sidebar">
                @foreach ($tags as $tag)
                    {{-- <li class="tag_id">{{ $tag->id }}</li> --}}
                    <li><a href="/?tag_id={{ $tag->id }}" +
                            class="tag_hover {{ Request::get('tag_id') == $tag->id ? 'tag_color tag_font' : '' }}">{{ $tag->id }}　{{ $tag->type }}</a>
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="gallery-container">
            @foreach ($phods as $phod)
                <div class="box">
                    <a href="{{ route('phods.show', $phod) }}">
                        <img src="{{ $phod->image_url }}" alt="">
                    </a>
                    <h3 class="title">{{ $phod->title }}</h3>
                    <div class="icons">

                        <div class="btn_flex">

                            @can('delete', $phod)
                                <form action="{{ route('phods.destroy', $phod) }}" id="form_recipe" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <input type="submit" value="削除" id="btn" class="btn btn_red">
                                </form>
                            @endcan

                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </section>
    <a href="{{ route('phods.index') }}" class="btn btn_blue">一覧</a>
    <script src="{{ asset('/js/index.js') }}"></script>

</x-app-layout>
