<x-app-layout>

    {{-- flash-message.blade.php読み込み --}}
    {{-- フラッシュメッセージ --}}
    <x-flash-message :message="session('notice')" />

    {{-- validation-errors.blade.php読み込み --}}
    {{-- エラーメッセージ --}}
    <x-validation-errors :errors="$errors" />

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
                    <a href="#" class="fab fa-facebook"></a>
                    <a href="#" class="fab fa-twitter"></a>
                    <a href="#" class="fab fa-instagram"></a>
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
