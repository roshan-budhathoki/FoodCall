@extends('driver.layout.drivermain')
 
@section('main-container')
 
 
 <!----------------- Order lists--------------->
 <div class="recent-grid">
    <div class="users">
        <div class="card">
            <div class="card-header">
                <h2>Order </h2>
            </div>
            <div class="card-body" style="padding: 20px;">
                <table width="100%" >
                    <thead>
                        <tr>
                            <td>User Name</td>
                            <td>Address</td>
                            <td>Contact</td>
                            <td>Order Id</td>
                            <td>Total</td>
                            <td>Status</td>
                            <td>View</td>
 
                        </tr>
                    </thead>
                    <tbody>
 
                    @foreach($orders as $order)
                        @foreach($assigned_orders as $assigned_order)
                           @if($assigned_order->order_id == $order->id)
                                <tr>
                                    <td>{{$order->username}}</td>
                                    <td>{{$order->address}}</td>
                                    <td>{{$order->contact}}</td>
                                    <td>{{$order->id}}</td>
                                    {{-- <td>Rs {{$order->Subtotal}}</td> --}}
                                    <td>Rs {{$order->Total}}</td>
                                    <td>
                                        @if($order->Order_status == "Delivered")
                                            <input type="text" value="Delivered" disabled/>
                                        @else
                                        <select name="form-control" id="order-status">
                                            <option value>Change Order Status</option>
                                            <option value="{{"Pending,".$order->id}}" {{$order->Order_status == "Pending" ? "Selected" : '' }}>Pending</option>
                                            <option value="{{"Moved To Deliver,".$order->id}}" {{$order->Order_status == "Moved To Deliver" ? "Selected" : '' }} >Moved To Deliver</option>
                                            <option value="{{"Delivered,".$order->id}}" {{$order->Order_status == "Delivered" ? "Selected" : '' }}>Delivered</option>
                                        </select>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="/assinedorderdetail/userId/{{$order->user_id}}/orderId/{{$order->id}}"><i class="fas fa-eye" style="font-size:1.5rem; color:#ec7474;" ></i></a>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
 
    </div>
</div>
 
 
 
 
 
 
</section>
</section>
 <script>
     $(document).on('change','select', function(){
         var item=$(this);
         $.ajax({
             url : "/changeOrderStatus",
             method : "POST",
             data : {
                 "_token" : "{{ csrf_token() }}",
                 order_status : item.val(),
             },
             success : function(response){
                if(response.success){
                    location.reload();
                }
             }
         });
     });
 </script>

<script>
    let client = "<?php $user_type = session('user_type'); echo strval($user_type); ?>";

        
    if(!navigator.geolocation) {
        console.log("Your browser doesn't support geolocation feature!")
    } else {
        setInterval(() => {
            if(client == "driver"){
                navigator.geolocation.getCurrentPosition(getPosition)
            }
        }, 2000);
    }

    var marker, circle;

    function getPosition(position){

        var lat = position.coords.latitude
        var long = position.coords.longitude

        if("{{session('user_type')}}" == "driver"){
            $.ajax({
                url: '/updateLocation',
                method: 'POST',
                data : {"lat" : lat, "long": long,"sender": "{{session('user')}}","_token":"{{ csrf_token() }}"},
                success: function (response){

                }
            });
        }
    }
    </script>
 
<!-- js file link -->
<script src="../Javascript/admin.js"></script>
<script src="../Javascript/read.js"></script>
 
 
 </body>
</html>
 
@endsection
 