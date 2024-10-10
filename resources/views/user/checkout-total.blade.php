<div class="iphone">
    <header class="header">
        <h1>Checkout</h1>
    </header>

    <form action="{{ route('paytm.order-pay') }}" class="form" method="POST">
        @csrf
        <div>
            <h2>Address</h2>
            <div class="card">
                @if ($address)
                    <input type="hidden" name="address_id" value="{{ $address->id }}">

                    <address>
                        {{ $address->name }}<br />
                        {{ $address->address }}, {{ $address->landmark }},
                        {{ $address->state }},<br />
                        {{ $address->city }}, {{ $address->pin_code }}<br />
                        {{ $address->phone }}
                    </address>
                @else
                    <button type="button" class="btn btn-success checkout" data-bs-toggle="modal"
                        data-bs-target="#staticBackdrop">
                        Add Address
                    </button>
                @endif

            </div>
        </div>

        <fieldset>
            <legend>Payment Method</legend>

            <div class="form__radios">
                <div class="form__radio">
                    <label for="visa"><img class="paytm" src="{{ asset('/img/paytm-icon.svg') }}"
                            alt="">Paytm</label>
                    <input checked id="visa" name="payment-method" type="radio" />
                </div>
            </div>
        </fieldset>

        <div>
            <h2>Shopping Bill</h2>

            <table>
                <tbody>
                    <tr>
                        <td>Shipping fee</td>
                        <td align="right">₹ 50</td>
                    </tr>
                    <tr>
                        <td>Discount</td>
                        <td align="right">₹0</td>
                    </tr>
                    <tr>
                        <td>Sub Total</td>
                        <td align="right">₹{{ $total }}</td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td>Total</td>
                        <td align="right">₹{{ $total + 50 }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <div>
            <button class="button button--full" type="submit"><svg class="icon">
                    <use xlink:href="#icon-shopping-bag" />
                </svg>Pay Now</button>
        </div>
    </form>
</div>

<svg xmlns="http://www.w3.org/2000/svg" style="display: none">
    <symbol id="icon-shopping-bag" viewBox="0 0 24 24">
        <path
            d="M20 7h-4v-3c0-2.209-1.791-4-4-4s-4 1.791-4 4v3h-4l-2 17h20l-2-17zm-11-3c0-1.654 1.346-3 3-3s3 1.346 3 3v3h-6v-3zm-4.751 18l1.529-13h2.222v1.5c0 .276.224.5.5.5s.5-.224.5-.5v-1.5h6v1.5c0 .276.224.5.5.5s.5-.224.5-.5v-1.5h2.222l1.529 13h-15.502z" />
    </symbol>
</svg>
