@extends('admin.adminlayout.adminmain', ['username' => session('username')])

@section('main-container')

<div class="recent-grid">
    <div class="users" style="box-shadow: 0 0 2px #808080;">
        <div class="card">
            <div class="card-header" style="
                display: flex;
                justify-content: center;
                background: #ff3838;
                color: #fff;
            ">
                <h2>Add Driver</h2>
            </div>
            <div class="Billing-details">
                <form action="/driveradd" class="checkout-form"  method="POST">
                    @csrf
                    <div class="form-group" style="width:95%;">
                        <label >UserName</label>
                        <input type="text" name="username" required>
                    </div>
                    
                    <div class="shipping-form">
                        <div class="form-group">
                            <label>Contact</label>
                            <input type="text" name="contact" required>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" required>
                        </div>
                    </div>
                    <div class="form-group" style="width:95%;">
                        <label>Adderess</label>
                        <textarea type="text" name="adderess" rows="4" required></textarea>
                    </div>
                    <div class="shipping-form">
                        <div class="form-group">
                            <label>Lisence Number</label>
                            <input type="text" name="lisenceNumber" required>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="text" name="password" required>
                        </div>
                    </div>
                        
                    <div class="form-group">
                        <label></label>
                        <input type="submit" value="Add driver">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection