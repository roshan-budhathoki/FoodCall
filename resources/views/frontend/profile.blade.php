@extends('frontend.layouts.basic')

@section('main-container')

<div class="Checkout-page">
    <h1> Edit Profile</h1>
</div>



<div class="profile-container">
    <main>
        <div class="account-page">
            <div class="profile-section">
                <div class="profile-detail">
                    <img src="../Image/user.png" alt="">
                    <h2>{{session('username')}}</h2>
                </div>
                <ul>
                    <li><a href="/profile" class="active">My account <span>></span></a></li>
                    <li><a href="/changepassword">Change password <span>></span></a></li>
                    <li><a href="/orderhistory">Order History <span>></span></a></li>
                    <!-- <li><a href="/profile">logout <span>></span></a></li> -->
                    <form action="/logout" method = "POST">
                        @csrf
                        <button class="stop-btn" type="submit">Logout<span>></span></button>
                    </form>
                </ul>
            </div>

        <!-------Edit Profile section--------->

            <div class="account-detail">
                <h2>Account<h2>
                <div class="Billing-details">
                <form class="checkout-form" action="/editprofile" method="POST">
                    @csrf
                        <div class="form-group" style="width:95%;">
                            <label>Username</label>
                            <input type="text" name="username" value="{{$user->username}}" required>
                        </div>
                    
                    <div class="shipping-form">
                        <div class="form-group">
                            <label>Country</label>
                            <input type="text" name="country" disabled="true" value="Nepal"  required>
                        </div>
                        <div class="form-group">
                            <label>City</label>
                            <input type="text" name="city" disabled="true" value="Biratnagar">
                        </div>
                    </div>
                    <div class="form-group" style="width:95%;">
                        <label>Adderess</label>
                        <textarea name="address" rows="4">{{$user->adderess}}</textarea>
                    </div>
                    <div class="shipping-form">
                        <div class="form-group">
                            <label>Contact Number</label>
                            <input type="text" name="contact" value="{{$user->contact}}" required>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" name="email" value="{{$user->email}}" required>
                        </div>
                    </div>
                    <br>
                    <div class="form-group">
                        <label></label>
                        <input type="submit" name="update" id="update" value="update">
                    </div>
                </form>
            </div>
            </div>
        </div>
    </main>

</div>
@endsection