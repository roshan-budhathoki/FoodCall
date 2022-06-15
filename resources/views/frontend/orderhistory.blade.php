@extends('frontend.layouts.basic')

@section('main-container')



<div class="Checkout-page">
    <h1>Order History</h1>
</div>

<div class="profile-container">
    <main style="height:1000px; overflow-x:scroll;">
        <div class="account-page">
            <div class="profile-section">
                <div class="profile-detail">
                    <img src="../Image/user.png" alt="">
                    <h2>{{session('username')}}</h2>
                </div>
                <ul>
                    <li><a href="/profile">My account <span>></span></a></li>
                    <li><a href="/changepassword">Change password <span>></span></a></li>
                    <li><a href="/orderhistory" class="active">Order History <span>></span></a></li>
                    
                    <form action="/logout" method = "POST">
                        @csrf
                        <button class="stop-btn" type="submit">Logout<span>></span></button>
                    </form>
                </ul>
            </div>
        
        <!------------ Order hsitory------------------->

        @if(count($orderNumbers) != 0)
            <div class="account-detail">
                <h2>Order History</h2>
                <div class="roww-head">
                    @foreach($orderNumbers as $orderNumber)
                    <div class="cardd-head">
                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
                            <div class="ms-card-head">
                                <div class="ms-card-img-tab" style="color:#111; ">
                                    <p>Order: {{$orderNumber->id}}</p>
                                </div>
                                <div class="ms-card-img-tab" style="color:#666;">
                                    <p>{{$orderNumber->created_at}}</p>
                                    <br>
                                </div>

                                @foreach($orders as $order)
                                @if($order->order_id == $orderNumber->order_id)
                                <div class="ms-card-body-tab">
                                    <div class="new-top">
                                        <h6 class="mb-0 text-top">{{$order->productname}}</h6>
                                        <div class="quantity-top">
                                            <h6 class="ms-text-primary mb-0 text-rs">Rs {{$order->price}}</h6>
                                            <h6 class="ms-text-primary mb-0 text-qty">Quantity: {{$order->Product_quantity}}</h6>
                                        </div>  
                                    </div>
                                </div>
                                <br>
                                @endif
                                @endforeach
                                
                                
                                <div class="total-tab">
                                    <h3>Subtotal : <span>Rs {{$orderNumber->Subtotal}}</span></h3>
                                    <h3>Charge: <span>Rs {{$orderNumber->Charge}}</span></h3>
                                    <h3>Total : <span>Rs {{$orderNumber->Total}}</span></h3> 
                                </div>
                                <div class="status-tab">
                                <p>{{$orderNumber->Order_status}}</p>
                                </div>
                                @if($orderNumber->Order_status == "Moved To Deliver")
                                 @foreach($driver_orders as $driver_order)
                                    @if($driver_order->order_id == $orderNumber->id)
                                        <a href="/getLocation/driverId/{{$orderNumber->driver_id}}" style="
                                        display: flex; 
                                        align-items: 
                                        center; 
                                        justify-content: center;
                                        background: #6495ED; 
                                        height:1.8rem; 
                                        color:#fff; 
                                        border-radius:1.2rem;
                                        ">Track Your Order</a>
                                    @endif
                                @endforeach  
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach   
                </div>
            </div>
        @else
        <div class="order-empty" style="display: flex; justify-content:center; margin-right:40rem; margin-top:10rem">
            <p style="
                font-size: 2rem;
                color:#666            
            ">There is not any order yet!!!<p>

        </div>
        @endif
        </div>
    </main>

</div>
@endsection

