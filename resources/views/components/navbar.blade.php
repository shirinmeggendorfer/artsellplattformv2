<!-- Navigationsleiste -->
<script src="{{ asset('js/checkMessages.js') }}"></script>

<nav class="light:base-color-dark  p-4 text-white fixed inset-x-0 bottom-0 flex justify-around">
    @if(auth()->check())
        <a href="{{ route('startPage') }}" class="iconHome"></a>
        <a href="{{ route('messages.index') }}" class="{{ $hasNewMessages ? 'iconNewMessage' : 'iconMessage' }}"></a>
        <a href="{{ route('items.createItem') }}" class="iconAddAd"></a>
        <a href="{{ route('profile.edit') }}" class="iconProfile"></a>
    @else
        <a href="{{ route('startPage') }}" class="iconHome">Login</a>
        <a href="{{ route('login') }}" class="iconMessage">Login</a>
        <a href="{{ route('login') }}" class="iconAddAd">Login</a>
        <a href="{{ route('login') }}" class="iconProfile">Login</a>
    @endif
</nav>