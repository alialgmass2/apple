<div>
    <a class="{{ Route::is('carts.index') ? 'active' : '' }}" href="{{ route('carts.index') }}">
        <span>{{ $cartCount }}</span>
        <img src="{{ asset('assets/images/cart.png') }}" width="30" height="30" alt="" />
    </a>
</div>
