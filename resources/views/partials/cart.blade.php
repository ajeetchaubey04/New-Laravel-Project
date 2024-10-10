{{--
<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
    <div class="offcanvas-header">

        <button type="button" class="btn-close text-reset off-can-buton" data-bs-dismiss="offcanvas"
            aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div class="shopping-cart">
            <!-- Title -->
            <div class="title">
                Your Cart
            </div>
            <div id="cart">
                @include('partials.cart-items')
            </div>
        </div>

        <div class="container">
            <div class="row mt-4">
                <a href="{{ route('user.checkout') }}" class="btn btn-success checkout"><i class="fa fa-shopping-cart color-white fs-5" aria-hidden="true"></i> Checkout</a>
            </div>
        </div>

    </div>
</div>

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
    <script src="{{ asset('website/js/cart.js') }}?v={{ time() }}"></script>
@endpush --}}
