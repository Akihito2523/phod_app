<x-app-layout>

    {{-- flash-message.blade.php読み込み --}}
    {{-- フラッシュメッセージ --}}
    <x-flash-message :message="session('notice')" />

    {{-- validation-errors.blade.php読み込み --}}
    {{-- エラーメッセージ --}}
    <x-validation-errors :errors="$errors" />

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

    <h2 class="headline">写真詳細</h2>

    <section class="container">
        <div class="card">
            <div class="bg-image">
                <img src="{{ $phod->image_url }}" alt="">
            </div>
            <div class="info">
                <h3>{{ $phod->title }}</h3>
                <p>撮影者:{{ $phod->user->name }}</p>
                <p>{{ $phod->body }}</p>
                <p>撮影場所:{{ $phod->place }}</p>
                <p>撮影日:<td>{{ \Carbon\Carbon::parse($phod->created_at)->format('Y:m:d') }}</td>
                </p>
                <p>{{ $phod->tag->type }}</p>
                <div class="icons">
                    <a href="https://ja-jp.facebook.com/" class="fab fa-facebook"></a>
                    <a href="https://twitter.com/" class="fab fa-twitter"></a>
                    <a href="https://www.instagram.com/" class="fab fa-instagram"></a>
                </div>
            </div>

            <div class="btn_flex">
                {{-- (認可の制御)自分が投稿した記事の場合のみ、編集ボタンと削除ボタンを表示 --}}
                @can('update', $phod)
                    <a href="{{ route('phods.edit', $phod) }}" class="btn">編集</a>
                @endcan

                @can('delete', $phod)
                    <form action="{{ route('phods.destroy', $phod) }}" id="form_recipe" method="post">
                        @csrf
                        @method('DELETE')
                        <input type="submit" value="削除" id="btn" class="btn btn_red">
                    </form>
                @endcan
            </div>

        </div>
    </section>

    <a href="{{ route('phods.index') }}" class="btn btn_blue">戻る</a>

    <script src="{{ asset('/js/index.js') }}"></script>

</x-app-layout>
<p>
