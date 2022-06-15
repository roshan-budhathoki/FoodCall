@extends('frontend.layouts.basic')

@section('main-container')

<div class="Checkout-page">
    <h1>Change Password</h1>
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
                    <li><a href="/profile" >My Account <span>></span></a></li>
                    <li><a href="/changepassword" class="active">Change password <span>></span></a></li>
                    <li><a href="/orderhistory">Order History <span>></span></a></li>
                    <!-- <li><a href="/profile">logout <span>></span></a></li> -->
                    <form action="/logout" method = "POST">
                        @csrf
                        <button class="stop-btn" type="submit">Logout<span>></span></button>
                    </form>
                </ul>
            </div>
            <div class="account-detail">
            @if(session('error'))
                    <div style="
                        background: #E9967A;
                        height: 3.5rem;
                        font-size: 15px;
                        border: 2px solid red;
                        color: white;
                    ">{{session('error')}}</div>

                    @endif
                    @if(session('success'))
                    <div style="
                        background: #d0f0c0;
                        height: 3.5rem;
                        font-size: 15px;
                        border: 2px solid green;
                        color: #111;
                    ">{{session('success')}}</div>
                    @endif
                <h2>Change Password<h2>
                <div class="Billing-details">
                    
                <form class="checkout-form" method="POST" action="/changePassword">
                @csrf    
                <div class="shipping-form">
                        <div class="form-group">
                            <label>Old password</label>
                            <input type="password" name="oldPassword">
                        </div>
                        <div class="form-group">
                            <label>New Password</label>
                            <input type="password" name="newPassword">
                        </div>
                    </div>
                        <div class="form-group">
                            <label>Confirm New password</label>
                            <input type="password" name="confirmPassword">
                        </div>

                        <div class="form-group">
                        <label></label>
                        <input type="submit" name="save" id="save" value="save">
                    </div>
                </form>
            </div>
            </div>
        </div>
    </main>
</div>
@endsection