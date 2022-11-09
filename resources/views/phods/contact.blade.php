<x-app-layout>

    <h2 class="headline">お問い合わせ</h2>

    {{-- validation-errors.blade.php読み込み --}}
    <x-validation-errors :errors="$errors" />

    <form action="{{ route('phods.store') }}" method="POST">
        @csrf

        <section class="contact_container">
            <div class="container">

                <div class="row100">
                    <div class="col">
                        <div class="inputBox">
                            <input type="text" name="name" required="required">
                            <span class="text">名前</span>
                            <span class="line"></span>
                        </div>
                    </div>
                </div>

                <div class="row100">
                    <div class="col">
                        <div class="inputBox">
                            <input type="text" name="email" required="required">
                            <span class="text">メールアドレス</span>
                            <span class="line"></span>
                        </div>
                    </div>
                </div>

                <div class="row100">
                    <div class="col">
                        <div class="inputBox textarea">
                            <textarea name="message" required="required"></textarea>
                            <span class="text">メッセージ</span>
                            <span class="line"></span>
                        </div>
                    </div>
                </div>

                <div class="row100">
                    <div class="col">
                        <input type="submit" value="送信">
                    </div>
                </div>

            </div>

        </section>
    </form>

    <a href="{{ route('phods.index') }}" class="btn btn_blue">戻る</a>

</x-app-layout>
