@if(count($checks) != 0)
@foreach($checks as $checks)
            <div class="box-tab">
                <form action="/deletecart" method="POST">
                    @csrf
                    <input type="text" value="{{$checks->id}}" name="id" hidden></input>
                    <button type="submit"> <i class="fas fa-trash"></i></button>
                </form>
                <img src="{{URL::asset('/menuimage/'.$checks->image)}}" alt="">
                <div class="content-tab">
                    <h3> {{$checks->productname}}</h3>
                    <span class="price_no">Rs {{$checks->price}}</span>
                    <br>
                    <span class="quantity"> qty : </span>
                    <input type="number" data-id="{{$checks->id}}" class="qty" name="quantity" value="{{$checks->quantity}}" id="">
                </div>
            </div>
        @endforeach
            <div class="total">
            <h3>Subtotal : <span>Rs {{$sum}}</span></h3>
            <h3>Delivery charge: <span>Rs 30</span></h3>
            <h3>Total : <span>Rs <?php echo($sum + 30); ?></span></h3>
            <a href="/checkout" class="btn"> Checkout</a>
            </div>
            @else
            <div style="color:#111; font-size:1.8rem;"><i class="fas fa-bell" style="color:#FFFF5C; font-size:1.8rem;"></i>&nbsp; Empty cart</div>
            @endif