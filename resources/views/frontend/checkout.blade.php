@extends('frontend.layouts.basic')

@section('main-container')


<div class="Checkout-page">
    <h1>Checkout</h1>
</div>

<div class="checkout-container">
    <main style="height: 900px;">
        <h2>Billing Details</h2>
        <div class="checkout-box">
            <div class="Billing-details">
                <div class="billing-head">
                    <h3>Shipping Details</h3>
                </div>
                <div class="checkout-form">
                    <div class="shipping-form">
                        <div class="form-group" style="width:97%;">
                            <label>Username</label>
                            <input type="text" name="lname" disabled="true" value="{{session('username')}}"  required>
                        </div>
                    </div>
                    <div class="shipping-form">
                        <div class="form-group">
                            <label>Country</label>
                            <input type="text" name="Nname" disabled="true" value="Nepal"  required>
                        </div>
                        <div class="form-group">
                            <label>City</label>
                            <input type="text" name="Cname" disabled="true" value="Biratnagar">
                        </div>
                    </div>
                    <div class="form-group" style="width:95%;">
                        <label>Adderess</label>
                        <textarea name="adderess" rows="4" required id="address">{{$user->adderess}}</textarea>
                    </div>
                </div>


                <div class="billing-head">
                    <h3>Contact Details</h3>
                </div>
                <div class="checkout-form">
                    <div class="shipping-form">
                        <div class="form-group">
                            <label>Contact Number</label>
                            <input type="text" value="{{$user->contact}}" id="contact" name="contacts" required>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" value="{{$user->email}}" name="Ename" id="email" required>
                        </div>
                    </div>
                    <div class="billing-head">
                        <h3>Aditional Inforation (Optional)</h3>
                    </div>
                    <div class="form-group" style="width:95%;">
                        <label>Note</label>
                        <textarea type="text" name="note" id="note" rows="4"></textarea>
                    </div>
                </div>

            </div>
            <div class="order-summary">
                <div class="checkout-total">
                    <h3>Order Summary</h3>
                        <ul>
                            <li>Subtotal: <span>Rs {{$sum}}</span></li>
                            <li>Delivery charge: <span>Rs 30</span></li>
                            <hr>
                            <li>Total Amount <span>Rs {{$sum + 30}}</span></li>
                            <hr>
                            <li><input type="radio" name="cod">Cash on Delivery</li>
                            <hr>
                            <li>
                                    <button id="newcheckout" type="submit">proceed to checkout</button>
                            <li>
                        </ul>
                </div>
            </div>
        </div>
    </main>
</div>

<script>
    $('#newcheckout').on('click', function(){
        let address = $('textarea[name=adderess]').val();
        let contact = $('input[name=contacts]').val();
        let email = $('input[name=Ename]').val();
        let note = $('textarea[name=note]').val();
        Snackbar.show({text: "Order has been palced", pos: 'top-left'});
        setTimeout(()=> {
            $.ajax({
                url : '/checkoutorder',
                type: 'POST',
                data: {address, contact, email, note, "_token": "{{ csrf_token() }}"},
                success:function(response){
                    window.location.href = "/orderhistory";
                }
            });
        }, 3000)

    });

</script>

@endsection