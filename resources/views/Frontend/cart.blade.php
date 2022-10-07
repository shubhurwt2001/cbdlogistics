@extends('Frontend.layouts.common')
@section('title','Cart - CBD Logistics')
@section('description','CBD Logistics')
@section('keywords','CBD Logistics')
@section('content')
@php
$locale = app()->getLocale();
$currency = session()->get('currency') ? session()->get('currency') : 'eur';
@endphp

<section class="about-breadcrumb">
    <div class="about-back section-tb-padding" style="background-image: url({{asset('public/image/breadcrumb-bg.jpg')}})">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="about-l">
                        <ul class="about-link">
                            <li class="go-home"><a href="{{url('/')}}">Home</a></li>
                            <li class="about-p"><span>Cart</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- breadcrumb end -->

<!-- collapse start -->
<section class="cart-page section-tb-padding">
    <div class="container">
        <div class="row">
            <div class="col-xl-9 col-xs-12 col-sm-12 col-md-12 col-lg-8">
                <div class="cart-item">
                    <span class="cart-head">My cart:</span>
                    @if(Auth::check())
                    <span class="c-items">0 item</span>
                    @else
                    <span class="c-items">{{count(session()->get('cart',[]))}} item</span>
                    @endif
                </div>

                @foreach($products as $product)
                <div class="cart-area" id="remove_cart_{{$product->cart_id}}">
                    <div class="cart-details">
                        <div class="cart-all-pro">
                            <div class="cart-pro">
                                <div class="cart-pro-image">
                                    @foreach($product->images as $image)
                                    @if($loop->iteration == 1)
                                    <a href="{{$product['slug_'.$locale]}}"><img src="{{asset('public'.$image['slug_'.$locale])}}" class="img-fluid" alt="image"></a>
                                    @endif
                                    @endforeach
                                </div>
                                <div class="pro-details">
                                    <h4><a href="{{$product['slug_'.$locale]}}">{{$product['name_'.$locale]}}</a></h4>
                                    @foreach($product->attributeGroup as $attr)
                                    <span class="pro-size"><span class="size">{{$attr['name_'.$locale]}}:</span>
                                        <select class="form-control attribute" data-pro="{{$product->id}}" id="attribute_{{$product->cart_id}}" data-group="{{$product->attribute}}" data-val="{{$product->cart_id}}">
                                            @foreach($product->allAttributes as $attribute)
                                            <option value="{{$attribute->id}}" @if($attribute->id == $product->attribute) selected @endif>{{$attribute->name}} {{$attr['name_'.$locale]}}</option>
                                            @endforeach
                                        </select>
                                    </span>
                                    @endforeach
                                    <span class="cart-pro-price" id="base_{{$product->cart_id}}"><strong>{{$currency}} {{$product['price_'.$currency]}}</strong></span>
                                </div>
                            </div>
                            <div class="qty-item">
                                <div class="center">
                                    <div class="plus-minus">
                                        <span>
                                            <a href="javascript:void(0)" class="minus-btn text-black">-</a>
                                            <input type="number" class="quantity" name="name" data-pro="{{$product->id}}" data-val="{{$product->cart_id}}" id="quantity_{{$product->cart_id}}" value="{{$product->cart_quantity}}">
                                            <a href="javascript:void(0)" class="plus-btn text-black">+</a>
                                        </span>
                                    </div>
                                    <a href="javascript:void(0)" onclick="cart('{{$product->cart_id}}','remove','')" class="pro-remove">Remove</a>
                                </div>
                            </div>
                            <div class="all-pro-price" id="price_{{$product->cart_id}}">
                                <span>{{$currency}} {{$product->cart_quantity*$product['price_'.$currency]}}</span>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @if(count($products) > 0)
            <div class="col-xl-3 col-xs-12 col-sm-12 col-md-12 col-lg-4">
                <div class="cart-total">
                    <div class="cart-price">
                        <span>Subtotal</span>
                        <span class="total">{{$currency}} {{$subtotal[$currency]}}</span>
                    </div>
                    <div class="cart-info">
                        <h4>Shipping info</h4>
                        <form>
                            <label>Country</label>
                            <select class="form-select" aria-label="Default select example">
                                <option>---</option>
                                <option>Afghanistan</option>
                                <option>Åland Islands</option>
                                <option>Albania</option>
                            </select>
                            <label>Zip/postal code</label>
                            <input type="text" name="code" placeholder="Zip/postal code">
                        </form>
                        <a href="javascript:void(0)" class="cart-calculate">Calculate</a>
                    </div>
                    <div class="shop-total">
                        <span>Total</span>
                        <span class="total-amount">{{$currency}} {{$subtotal[$currency]}}</span>
                    </div>
                    <a href="javascript:void(0)" class="check-link">Checkout</a>
                </div>
            </div>
            @endif
        </div>
    </div>
</section>
@section('scripts')
<script>
    var products = <?php echo json_encode($products); ?>;
    var currency = <?php echo json_encode($currency); ?>;

    $(document).on('change', '.attribute', function() {
        var cart_id = $(this).attr('data-val');
        var group = $(this).attr('data-group');
        var pro = $(this).attr('data-pro');
        var value = $(this).val();
        var quantity = $(`#quantity_${cart_id}`).val();
        const item = products.filter(function(product, index) {
            return product.cart_id == cart_id
        })

        if (item.length > 0) {
            item[0].allAttributes.map(function(attribute) {
                if (attribute.id == value) {
                    $(`#base_${cart_id}`).html(`<strong>${currency} ${attribute['price_'+currency]}</strong>`)
                    $(`#price_${cart_id}`).html(`<span>${currency} ${(attribute['price_'+currency]*quantity)}</span>`);
                }
            })

            $.ajax({
                type: "POST",
                data: {
                    type: 'attribute',
                    product_id: pro,
                    cart_id: cart_id,
                    attribute: value,
                    group: group,
                    _token: "{{csrf_token()}}"
                },
                url: '{{route("cart")}}',
                success: function(data) {
                    window.location.reload();
                },
                error: function(err) {
                    console.log(err);
                    alert(err.responseJSON.message)
                    window.location.reload()
                }
            })
        }
    })


    $(document).on('change', '.quantity', function() {
        var id = $(this).attr('data-val');
        var product = $(this).attr('data-pro');
        var quantity = $(this).val();
        var group = $(`#attribute_${id}`).attr('data-group');
        var value = $(`#attribute_${id}`).val();

        if (quantity <= 0) {
            alert("Minimum quantity should be 1");
            window.location.reload()
        } else {
            $.ajax({
                type: "POST",
                data: {
                    type: 'quantity',
                    product_id: id,
                    quantity: quantity,
                    _token: "{{csrf_token()}}",
                    product: product
                },
                url: '{{route("cart")}}',
                success: function(data) {
                    window.location.reload();
                    products.map(function(product, index) {
                        if (product.cart_id == id) {
                            product.allAttributes.map(function(attribute) {
                                if (attribute.id == value) {
                                    $(`#price_${id}`).html(`<span>${currency} ${parseFloat(attribute['price_'+currency]*quantity).toFixed(2)}</span>`);
                                }
                            })
                        }
                    })
                },
                error: function(err) {
                    console.log(err);
                    alert(err.responseJSON.message)
                    window.location.reload()
                }
            })
        }
    })
</script>
@endsection
@endsection