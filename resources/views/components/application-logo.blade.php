<header class="page-header wrapper">
    <h1><a href="{{ route('root') }}"><img src="{{ asset('images/logo.png') }}" alt="写真" class="logo"></a></h1>

    <nav>
        <ul class="main-nav">
            <li> <a href="{{ route('root') }}">HOME</li>
            <li><a href="{{ route('list') }}">List</a></li>
            <li><a href="{{ route('contact') }}">Contact</a></li>
            <li><a href="{{ route('tags.index') }}">Tag</a></li>
</a></li>
            {{-- <li><a href="/phods/contacct">Contact</a></li> --}}
        </ul>
    </nav>
</header>


{{-- <header class="header">
    <div class="logo">
        <h1><a href="{{ route('root') }}"><img src="{{ asset('images/logo.png') }}" alt="写真" class="logo"></a></h1>
    </div>
    <nav class="nav">
        <ul class="ul">
            <li> <a href="{{ route('root') }}">HOME</li>
            <li><a href="{{ route('table') }}">Table</a></li>
            <li><a href="{{ route('contact') }}">Contact</a></li>
        </ul>
    </nav>
</header> --}}
