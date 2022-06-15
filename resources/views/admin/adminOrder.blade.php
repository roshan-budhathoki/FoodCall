@extends('admin.adminlayout.adminmain', ['username' => session('username')])
 
@section('main-container')
        <!----------------- Order lists--------------->
        <div class="recent-grid">
                <div class="users">
                    <div class="card">
                        <div class="card-header">
                            <h2>Order list</h2>
                        </div>
                        <div class="card-body" style="padding: 20px; overflow: scroll;">
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
                                        <td>Assign Order</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($orders as $order)
                                    <tr>
                                        <td>{{$order->username}}</td>
                                        <td>{{$order->address}}</td>
                                        <td>{{$order->contact}}</td>
                                        <td>{{$order->id}}</td>
                                        {{-- <td>Rs {{$order->Subtotal}}</td> --}}
                                        <td>Rs {{$order->Total}}</td>
                                        <td>
                                            <p style="
                                            background:#228B22;
                                            height:1.8rem;
                                            color:#fff;
                                            border-radius:1.2rem;
                                            display:flex;
                                            justify-content:center;
                                            align-items: center;
                                            width: 9rem;
                                            ">{{$order->Order_status}}</p>
                                        </td>
                                        <td>
                                            <a href="/adminOrderDetails/userId/{{$order->user_id}}/orderId/{{$order->id}}"><i class="fas fa-eye" style="font-size:1.5rem; color:#ec7474;" ></i></a>
                                        </td>
                                        <td>
                                            @foreach($order_driver as $driver)
                                                @if($driver->order_id == $order->id && $driver->driver_id == -1)
                                                    <select name="form-control" id="drivername">
                                                        <option value>Select Driver</option>
                                                        @foreach($driverselect as $driver)
                                                            <option value="{{$driver->username.",".$order->id}}">{{$driver->username}}</option>
                                                        @endforeach
                                                    </select>
                                                @elseif($driver->order_id == $order->id && $driver->driver_id != -1)
                                                    <input type="text" value="{{$driver->username}}" disabled/>
                                                @endif
                                            @endforeach
                                        </td>
                                    </tr>
                                    @endforeach
 
 
                                </tbody>
                            </table>
                        </div>
                    </div>
 
                </div>
            </div>
        </section>
</section>
 
        <!-- js file link -->
        <script src="../Javascript/admin.js"></script>
        <script src="../Javascript/read.js"></script>
 
 
        <script>
            $('#drivername').change(function() {
                var item=$(this);
                $.ajax({
                    url : "/assignorder",
                    method : "POST",
                    data : {
                        "_token" : "{{ csrf_token() }}",
                        driver_order : item.val(),
                    },
                    success : function(response){
                        if(response.success){
                            location.reload();
                        }
                    }
                });
            });
        </script>
 
    </body>
</html>
 
@endsection