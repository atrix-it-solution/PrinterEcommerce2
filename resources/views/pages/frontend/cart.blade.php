@extends('layouts.frontend.master')

@section('title', 'Shopping Cart ')

@section('content')
        <div class="bodyWrapper flex-grow-1">
            <section class="subheader py-5" style="background-image: url('assets/frontend/images/cartbg.jpg');">
                <div class="container py-lg-5">
                    <div class="row">
                        <div class="col-md-6 text-white">
                            <h1 class="text-dark">Cart</h1>
                        </div>
                    </div>
                </div>
            </section>

            @if(count($cart) == 0)
            <section class="cart_empty py-5" >
                <div class="container py-lg-5">
                    <div class="cart_empty_inner text-center">
                        <div class="empty_img mb-4">
                            <img src="{{ asset('assets/frontend/images/cart_icon.svg') }}" alt="Cart Empty" class="img-fluid" />
                        </div>
                        <h4 class="fw-light py-2">Your cart is currently empty.</h4>
                        <div class="shopbtn pt-3">
                            <a href="{{ route('shop') }}" class="cusbtn btn btn-dark rounded-0 px-5 py-3">Return to Shop <i class="fa-solid fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </section>
            @else
            <section class="cart_sec py-5">
                <div class="container py-lg-5">
                    <div class="notices-wrapper"></div>
                    <div class="row gx-lg-5">
                        <div class="col-lg-8 my-3">
                            <form action="{{ route('cart.update') }}" class="cart-form" id="cartForm">
                                @csrf
                                <table class="shop_table shop_table_responsive cart">
                                    <thead class="hidden-xs">
                                        <tr>
                                            <th class="product-thumbnail ps-0">Product</th>
                                            <th class="product-name"></th>
                                            <th class="product-price text-center">Price</th>
                                            <th class="product-quantity text-center">Quantity</th>
                                            <th class="product-subtotal text-end pe-0">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($cart as $item)
                                        <tr class="cart_item" id="cart-item-{{ $item['product_id'] }}">
                                            <td class="product-thumbnail">
                                                <a href="{{ route('product.show', $item['slug']) }}">
                                                    <img src="{{ $item['image'] }}" class="img-fluid" alt="{{ $item['title'] }}">

                                                </a>
                                            </td>
                                            <td class="product-name" data-title="Product">
                                                <a href="{{ route('product.show', $item['slug']) }}">{{ $item['title'] }}</a>
                                                <div class="product-remove">
                                                    <a href="#" class="remove" onclick="removeFromCart({{ $item['product_id'] }})">Remove</a>
                                                </div>
                                            </td>
                                            <td class="product-price" data-title="Price">
                                                <span class="amount">
                                                    @if($item['sale_price'] && $item['sale_price'] < $item['regular_price'])
                                                    <del aria-hidden="true">
                                                        <span class="price-amount amount"><bdi><span class="price-currencySymbol">$</span>{{ number_format($item['regular_price'], 2) }}</bdi></span>
                                                    </del>
                                                    <ins aria-hidden="true">
                                                        <span class="price-amount amount"><bdi><span class="price-currencySymbol">$</span>{{ number_format($item['sale_price'], 2) }}</bdi></span>
                                                    </ins>
                                                    @else
                                                    <span class="price-amount amount"><bdi><span class="price-currencySymbol">$</span>{{ number_format($item['regular_price'], 2) }}</bdi></span>
                                                    @endif
                                                </span>
                                            </td>
                                            <td class="product-quantity" data-title="Quantity">
                                                <div class="quantity ">
                                                      <span class="svg-icon--minus qty-button" onclick="updateQuantity({{ $item['product_id'] }}, -1)">
                                                        <svg aria-hidden="true" role="img" focusable="false" width="12" height="2" viewBox="0 0 12 2" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path d="M11.998 1.85689H6.85519H5.1409H-0.00195312V0.142604H5.1409L6.85519 0.142578L11.998 0.142604V1.85689Z"></path></svg>
                                                    </span>
                                                     <input type="number" 
                                                            id="quantity-{{ $item['product_id'] }}" 
                                                            class="input-text qty text cart-quantity" 
                                                            name="quantities[{{ $item['product_id'] }}]" 
                                                            value="{{ $item['quantity'] }}" 
                                                            aria-label="Product quantity" 
                                                            min="1" 
                                                            max="{{ $item['stock_quantity'] ?? '' }}" 
                                                            step="1" 
                                                            placeholder="" 
                                                            inputmode="numeric" 
                                                            autocomplete="off"
                                                            onchange="updateQuantityInput({{ $item['product_id'] }}, this.value)">
                                                    <span class="svg-icon--plus qty-button" onclick="updateQuantity({{ $item['product_id'] }}, 1)">
                                                        <svg aria-hidden="true" role="img" focusable="false" width="12" height="12" viewBox="0 0 12 12" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path d="M11.998 6.85714H6.85519V12H5.1409V6.85714H-0.00195312V5.14286H5.1409V0H6.85519V5.14286H11.998V6.85714Z"></path></svg>
                                                    </span>
                                                </div>
                                            </td>
                                            <td class="product-subtotal text-end" data-title="Total">
							                     <span class="price-amount amount item-total" id="item-total-{{ $item['product_id'] }}">
                                                    <bdi><span class="price-currencySymbol">$</span>{{ number_format($item['price'] * $item['quantity'], 2) }}</bdi>
                                                </span>
                                                <br>
                                                 @if($item['sale_price'] && $item['sale_price'] < $item['regular_price'])
                                                <span class="price-saved">
                                                    Save: <span class="price-amount amount">
                                                        <bdi><span class="price-currencySymbol">$</span>{{ number_format(($item['regular_price'] - $item['sale_price']) * $item['quantity'], 2) }}</bdi>
                                                    </span>
                                                </span>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                        
                                        <tr>
				                            <td colspan="6" class="actions">
                                                <div class="actions_inner">
                                                    <div class="coupon">
                                                        <label for="coupon_code" class="screen-reader-text d-none">Coupon:</label> 
                                                        <input type="text" name="coupon_code" class="form-control" id="coupon_code" value="" placeholder="Coupon code">
                                                        <button type="submit" class="btn btn-dark" name="apply_coupon" value="Apply coupon">Apply coupon</button>
                                                    </div>
                                                    <button type="submit" class="btn btn-dark button-update-cart" name="update_cart" value="Update cart" disabled="">Update cart</button>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="form-row notes mt-4" id="order_comments_field">
                                    <label for="order_comments" class="pb-2">Order notes</label>
                                    <textarea name="order_comments" class="form-control" id="order_comments" placeholder="Notes about your order, e.g. special notes for delivery." rows="4" cols="5"></textarea>
                                </div>
                            </form>
                        </div>
                        <div class="col-lg-4 my-3">
                            <div class="cart_totals">
                                <div class="cart_totals_summary">
                                    <h2>Cart totals</h2>
                                    <table cellspacing="0" class="shop_table shop_table_responsive">
                                        <tbody>
                                            <tr class="cart-subtotal">
                                                <th>Subtotal</th>
                                                <td data-title="Subtotal" class="product-subtotal text-end">
                                                    <span class="price">
                                                        <span class="price-amount amount" id="cart-subtotal">
                                                            <bdi><span class="price-currencySymbol">$</span>{{ number_format($subtotal, 2) }}</bdi>
                                                        </span> 
                                                        @if($totalSavings > 0)
                                                        <br>
                                                        <span class="price-saved">Save: <span class="price-amount amount"><bdi><span class="price-currencySymbol">$</span>{{ number_format($totalSavings, 2) }}</bdi></span></span>
                                                        @endif
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr class="order-total">
                                                <th>Total</th>
                                                <td class="text-end" data-title="Total"><strong><span class="price-amount amount" id="cart-total">
                                                    <bdi><span class="price-currencySymbol">$</span>{{ number_format($total, 2) }}</bdi>
                                                </span></strong> </td>
                                            </tr>
                                        </tbody>
                                    </table>

                                    <div class="wc-proceed-to-checkout">
                                        <a href="checkout" class="checkout-button btn btn-dark w-100 text-uppercase">Proceed to checkout</a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
             @endif

            <hr style="opacity: .1;">

            <section class="features_sec py-5">
                <div class="container">
                    <div class="row">
                        <div class="col-6 col-xl-3 my-3">
                            <div class="feature_box">
                                <div class="feature_icon">
                                    <img src="{{ asset('assets/frontend/images/sicon1.svg') }}" alt="Complimentary Shipping" class="img-fluid" />
                                </div>
                                <h4>Complimentary Shipping</h4>
                                <p>Free worldwide shipping and returns - customs and duties taxes included.</p>
                            </div>
                        </div>
                        <div class="col-6 col-xl-3 my-3">
                            <div class="feature_box">
                                <div class="feature_icon">
                                    <img src="{{ asset('assets/frontend/images/sicon2.svg') }}" alt="Customer service" class="img-fluid" />
                                </div>
                                <h4>Customer service</h4>
                                <p>We are available from Monday-Friday to answer your questions.</p>
                            </div>
                        </div>
                        <div class="col-6 col-xl-3 my-3">
                            <div class="feature_box">
                                <div class="feature_icon">
                                    <img src="{{ asset('assets/frontend/images/sicon3.svg') }}" alt="Secure payment" class="img-fluid" />
                                </div>
                                <h4>Secure payment</h4>
                                <p>Your payment information is processed securely.</p>
                            </div>
                        </div>
                        <div class="col-6 col-xl-3 my-3">
                            <div class="feature_box">
                                <div class="feature_icon">
                                    <img src="{{ asset('assets/frontend/images/sicon4.svg') }}" alt="Contact us" class="img-fluid" />
                                </div>
                                <h4>Contact us</h4>
                                <p>Need to contact us? Send us an e-mail at support@printhelp.com</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>


        <script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize quantity buttons
    initializeCartQuantityButtons();
});

function initializeCartQuantityButtons() {
    // Add event listeners to all quantity inputs
    document.querySelectorAll('.cart-quantity').forEach(input => {
        input.addEventListener('change', function() {
            const productId = this.name.match(/\[(\d+)\]/)[1];
            updateQuantityInput(productId, this.value);
        });
    });
}

function updateQuantity(productId, change) {
    const input = document.getElementById(`quantity-${productId}`);
    let newQuantity = parseInt(input.value) + change;
    
    // Ensure quantity doesn't go below 1
    if (newQuantity < 1) newQuantity = 1;
    
    // Check stock limit if available
    const max = parseInt(input.max);
    if (max && newQuantity > max) {
        newQuantity = max;
        alert(`Only ${max} items available in stock.`);
    }
    
    input.value = newQuantity;
    updateCartItem(productId, newQuantity);
}

function updateQuantityInput(productId, quantity) {
    let newQuantity = parseInt(quantity);
    
    // Ensure quantity doesn't go below 1
    if (newQuantity < 1 || isNaN(newQuantity)) newQuantity = 1;
    
    // Check stock limit if available
    const input = document.getElementById(`quantity-${productId}`);
    const max = parseInt(input.max);
    if (max && newQuantity > max) {
        newQuantity = max;
        alert(`Only ${max} items available in stock.`);
        input.value = newQuantity;
    }
    
    updateCartItem(productId, newQuantity);
}

function updateCartItem(productId, quantity) {
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '{{ csrf_token() }}';
    
    fetch('{{ route("cart.update") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken,
            'Accept': 'application/json'
        },
        body: JSON.stringify({
            product_id: productId,
            quantity: quantity
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Update item total
            document.getElementById(`item-total-${productId}`).innerHTML = 
                `<bdi><span class="price-currencySymbol">$</span>${data.item_total}</bdi>`;
            
            // Update cart totals
            document.getElementById('cart-subtotal').innerHTML = 
                `<bdi><span class="price-currencySymbol">$</span>${data.cart_total}</bdi>`;
            document.getElementById('cart-total').innerHTML = 
                `<bdi><span class="price-currencySymbol">$</span>${data.cart_total}</bdi>`;
            
            // Update cart count in header
            updateCartCount(data.cart_count);
        } else {
            alert(data.message);
            // Reset input to previous value
            location.reload();
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Something went wrong. Please try again.');
        location.reload();
    });
}

function removeFromCart(productId) {
    if (!confirm('Are you sure you want to remove this item from your cart?')) {
        return;
    }
    
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '{{ csrf_token() }}';
    
    fetch('{{ route("cart.remove") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken,
            'Accept': 'application/json'
        },
        body: JSON.stringify({
            product_id: productId
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Remove item from DOM
            document.getElementById(`cart-item-${productId}`).remove();
            
            // Update cart totals
            document.getElementById('cart-subtotal').innerHTML = 
                `<bdi><span class="price-currencySymbol">$</span>${data.cart_total}</bdi>`;
            document.getElementById('cart-total').innerHTML = 
                `<bdi><span class="price-currencySymbol">$</span>${data.cart_total}</bdi>`;
            
            // Update cart count in header
            updateCartCount(data.cart_count);
            
            // If cart is empty, show empty cart message
            if (data.cart_count === 0) {
                location.reload();
            }
        } else {
            alert(data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Something went wrong. Please try again.');
    });
}

function updateCartCount(count) {
    const cartCountElements = document.querySelectorAll('.cart-count, .cart-count-badge');
    cartCountElements.forEach(element => {
        element.textContent = count;
        element.style.display = count > 0 ? 'inline' : 'none';
    });
}
</script>
        @endsection