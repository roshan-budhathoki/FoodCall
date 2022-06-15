@extends('driver.layout.drivermain')
 
@section('main-container')
 

<div class="order-tab">
    <div class="order-head">
        <div class="order-heading">
            <h2>Order Details</h2>
        </div>
        <div class="order-table">
            <div class="tab-table">

                <p>Order-><span>{{$details->username}}</span></p>
            </div>
            <table> 
                @foreach($orders as $order) 
                <tr>
                    <td>{{$order->productname}}</td>
                        <td>
                            Restaurant = {{$order->restaurantname}}
                            Quantity = {{$order->Product_quantity}}
                            <br>
                            Price = Rs {{$order->price}}
                        </td>
                </tr>
                @endforeach
            </table>
        </div>
        <div class="total">
            <h3>Subtotal : <span>Rs {{$order->Subtotal}}</span></h3>
            <h3>Delivery charge: <span>Rs 30</span></h3>
            <h3>Total : <span>Rs {{$order->Total}}</span></h3>
        </div>
    </div>
</div>




@endsection