@extends('home.layouts.masterHome')
@section('css')
@endsection
@section('script')
    <script>
        function changeQuantity(event, id, cartName = null) {
            //
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content,
                    'Content-Type': 'application/json'
                }
            })

            //
            $.ajax({
                type: 'POST',
                url: '/cart/quantity/change',
                data: JSON.stringify({
                    id: id,
                    quantity: event.target.value,
                    // cart : cartName,
                    _method: 'patch'
                }),
                success: function (res) {
                    location.reload();
                }
            });
        }

    </script>
@endsection
@section('content')
    <div class="container px-3 my-5 clearfix">
        <!-- Shopping cart table -->
        <div class="card">
            <div class="card-header">
                <h2>Shopping Cart</h2>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered m-0">
                        <thead>
                        <tr>
                            <!-- Set columns width -->
                            <th class="text-left py-3 px-4" style="min-width: 400px;">Product Name</th>
                            <th class="text-right py-3 px-4" style="width: 150px;">Unit Price</th>
                            <th class="text-center py-3 px-4" style="width: 120px;">Number</th>
                            <th class="text-right py-3 px-4" style="width: 150px;">Final Price</th>
                            <th class="text-center align-middle py-3 px-0" style="width: 40px;">
                                <a href="#" class="shop-tooltip float-none text-light" title=""
                                   data-original-title="Clear cart">
                                    <i class="ino ion-md-trash"></i>
                                </a>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach(\Cart::all() as $cart)
                            @if (isset($cart['product']))
                                @php
                                    $product=$cart['product'];
                                @endphp
                                <tr>
                                    <td class="p-4">
                                        <div class="media align-items-center">
                                            <div class="media-body">
                                                <a href="#" class="d-block text-dark">{{$product->title}}</a>
                                                @if($product->attributes)
                                                    @foreach($product->attributes->take(3) as $attr)
                                                        <small>| &nbsp;
                                                            <span class="text-muted">{{$attr->name}} :  </span>
                                                            {{$attr->pivot->value->value}} &nbsp;
                                                        </small>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-right font-weight-semibold align-middle p-4">{{$product->price}}$
                                    </td>
                                    <td class="align-middle p-4">
                                        <select onchange="changeQuantity(event,'{{$cart['id']}}')"
                                                class="form-control text-center btn-sm">
                                            @foreach(range(1,$product->stock) as $item)
                                                <option
                                                    value="{{$item}}" {{$cart['quantity'] == $item ? 'selected' : ''}}>{{$item}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td class="text-right font-weight-semibold align-middle p-4">
                                        $ {{$product->price * $cart['quantity']}}</td>
                                    <td class="text-center align-middle px-0">
                                        <form action="{{route('cart.destroy',$cart['id'])}}" method="post"  id="deleteCart-{{$product->id}}">
                                            @csrf
                                            @method('delete')
                                        </form>
                                        <a href="#" onclick="event.preventDefault();document.getElementById('deleteCart-{{$product->id}}').submit();" class="shop-tooltip close float-none text-danger" >
                                            ×
                                        </a>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <hr>
                <!-- / Shopping cart table -->
                <div class="d-flex flex-wrap justify-content-between align-items-center pb-4 pr-4">
                    <div class="mt-4">
                        <form action="{{route('cart.payment')}}" method="post" id="paymentCart">
                            @csrf
                        </form>
                        <button onclick="document.getElementById('paymentCart').submit();" type="button" class="btn btn-sm btn-primary mt-2">Payment</button>
                    </div>
                    <div class="d-flex">
                        {{--                        <div class="text-right mt-4 mr-5">--}}
                        {{--                            <label class="text-muted font-weight-normal m-0">Discount</label>--}}
                        {{--                            <div class="text-large"><strong>$20</strong></div>--}}
                        {{--                        </div>--}}
                        <div class="text-right mt-4">
                            @php
                                $totalPrice=\App\Services\Cart\Cart::all()->sum(function ($cart){
                                   return $cart['product']->price * $cart['quantity'];
                                })
                            @endphp
                            <label class="text-muted font-weight-normal m-0">Total Price: <strong>{{$totalPrice}}
                                    $</strong></label>
                            {{--                            <div class="text-large"><strong>{{$totalPrice}} $</strong></div>--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
