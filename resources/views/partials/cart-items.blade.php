{{-- @forelse ($carts as $cart)

    <div class="item">
        <div class="buttons">
            <span class="delete-btn"
                onclick="removeFromCart('{{ route('post-remove-from-cart') }}', '{{ $cart->id }}')"></span>

        </div>

        <div class="image">
            @if ($cart->item && $cart->item->featuredImage)
                <img src="{{ asset($cart->item->featuredImage->file) }}" alt="{{ $cart->item->title }}">
            @endif
        </div>

        <div class="description">
            <span>{{ $cart->item->title }}</span>
            <span>{{ $cart->quantity }} x {{ $cart->variation->title }}</span>
        </div>

        <div class="quantity">
            <button class="minus-btn" type="button" name="button"
                onclick="minus('{{ route('post-minus-item-cart') }}', '{{ $cart->id }}')">
                <img src="/website/img/minus.svg" alt="" />
            </button>
            <input type="text" name="name" disabled value="{{ $cart->quantity }}">
            <button class="plus-btn" type="button" name="button"
                onclick="plus('{{ route('post-plus-item-cart') }}', '{{ $cart->id }}')">
                <img src="/website/img/plus.svg" alt="" />
            </button>
        </div>

        <div class="total-price">INR {{ $cart->quantity * $cart->variation->price }}</div>
    </div>

@empty
    <div class="empty-cart">
        <img src="{{ asset('website/img/empty-cart.svg') }}" alt="empty cart">
    </div>
@endforelse --}}
