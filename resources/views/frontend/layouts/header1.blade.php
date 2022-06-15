<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>FoodCall</title>

        <!-- font awesome cdn link-->
        <script src="https://kit.fontawesome.com/3228ac2f51.js" crossorigin="anonymous"></script>

        <!-- CSS file-->
        <link href="{{URL::asset('/css/index.css')}}" rel="stylesheet">
        <link href="{{URL::asset('/css/login.css')}}" rel="stylesheet">
        <link href="{{URL::asset('/css/restaurant.css')}}" rel="stylesheet">
        <link href="{{URL::asset('/css/menu.css')}}" rel="stylesheet">
        <link href="{{URL::asset('/css/checkout.css')}}" rel="stylesheet">
        <link href="{{URL::asset('/css/profile.css')}}" rel="stylesheet">
        <link href="{{URL::asset('/css/orderhistory.css')}}" rel="stylesheet">


        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js">
        </script>
        
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/node-snackbar@latest/src/js/snackbar.min.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/node-snackbar@latest/dist/snackbar.min.css" />

        

        <script>
            let username = "{{session('username')}}";
            console.log (username); 
        </script>

        
    </head>


    <body>
        <!----------------Header section starts here--------------->
        <header>
            <a href="#" class="logo"><i class="fas fa-utensils"></i>FoodCall</a>
            <div class="header-info-left">
                <ul>
                    <li>
                        @if(!session('user'))
                        <a href="#" id="modalbtn1"><i class="far fa-user"></i>Login</a>
                        @endif
                        @if(session('user'))
                        <div class="cartno" style="
                            position: absolute;
                            margin-left: 9.2rem;
                            background: none;
                            z-index: 20;
                            margin-top: -0.6rem;
                            color: #666;
                            font-size:1.5rem;
                        ">{{$count}}</div>
                        {{-- <div id="notofication1" class="fas fa-bell"></div> --}}
                        
                        
                        <div id="profile1" class="fas fa-user"></div>
                        <div id="cart1" class="fas fa-shopping-cart"></div>
                        @endif
                    </li>
                    @if(!session('user'))
                    <li><a href="#" id="popupbtn1"><i class="fas fa-lock"></i>Register</a></li>
                    @endif
                </ul>
            </div>
            <div id="menu-bar" class="fas fa-bars"></div>
        <nav class="navbar">
            <a href={{ route('home') }}>Home</a>
            <a href={{ route('home') }}>Restaurants</a>
            <a href={{ route('home') }}>Popular Offers</a>
            <a href={{ route('home') }}>AboutUs</a>
        </nav> 
        <div class="header-info-right">
            <ul>
            <li>
                @if(!session('user'))
                <a href="#" id="modalbtn"><i class="far fa-user"></i>Login</a>
                @endif
                @if(session('user'))
                <div class="cartno" style="
                    position: absolute;
                    margin-left: 9.2rem;
                    background: none;
                    z-index: 20;
                    margin-top: -0.6rem;
                    color: #666;
                    font-size:1.5rem;
                ">{{$count}}</div>
                {{-- <div id="notofication-btn" class="fas fa-bell"></div> --}}
                
                
                <div id="profile-btn" class="fas fa-user"></div>
                <div id="cart-btn" class="fas fa-shopping-cart"></div>
                @endif
            </li>
            @if(!session('user'))
            <li><a href="#" id="popupbtn"><i class="fas fa-lock"></i>Register</a></li>
            @endif
                
            </ul>
        </div>


        <!------------- shopping ----------------->
        <div class="shopping-cart" id="cartstorage" style="display:block;">
        @if(count($checks) != 0)
            @foreach($checks as $checks)
                <div class="box-tab">
                <form action="/deletecart" method="POST" >
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
        </div>

        <!-----------------------Profile section ---------------------------->
        <div class="profile-inner" style="background-color: #fff;">
            <div class="Profile-wrapper">
                <div class="Profile-inners" >
                    <span class="profile-text">MY PROFILE</span>
                    <div class="main-profile">
                        <div class="profile-image">
                            <img src="../Image/user.png" alt="">
                        </div>
                        <span class="profile-name">{{session('username')}}</span>
                        <span><a href="/profile" class="edit">Edit Profile</a><span>
                    </div>
                    <hr>
                    <div class="profile-details">
                        <ul class="navigation">
                            <li>
                                <a href="/orderhistory">
                                    <span class="bag fas fa-history"></span>
                                    <span class="profile-link">Order History</span>
                                </a>
                            </li>
                            <li>
                                <a href="/changepassword">
                                    <span class="bag fas fa-eye"></span>
                                    <span class="profile-link">Change password</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="profile-tab">
                        <form action="/logout" method = "POST">
                            @csrf
                            <button class="pro-btn" type="submit">Logout</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        </header>
        <!---------------Header section ends here----------------->


        <!---------------Login section starts here----------------->
        
            <div class="logbox" id="modal">
                <div class="logbox1">
                    <div class="login">
                        <form class="login-form" id="login" method="POST">
                            @csrf
                            <div style="display: flex; flex-direction: row-reverse; margin-bottom: 2px; font-size: 20px;">
                                <label for="" class="closebtn fas fa-times"></label>
                            </div>
                            <div class="close">
                                <div></div>
                                <div>
                                    <p class="login-text">Login</p>
                                </div>
                                <div>
                                    
                                </div>
                            </div>
                            <div id="login_error">
                            </div>
                            <div class="input-group">
                                <input type="email" placeholder="Email" name="email" id="login_email" required>
                            </div>
                            <div class="input-group">
                                <input type="password" placeholder="Password" name="password" id="login_password" required>
                            </div>
                            <div class="input-group">
                                <button class="logbtn">Login</button>
                            </div>
                            <p class="login-register">Don't have an account? <a href="#" id="Show_register">Register Here</a></p>
                        </form>
                    </div>
                </div>
            </div>
        <!---------------Login section ends here----------------->



        <!---------------Register section starts here----------------->

        <div class="Regbox" id="popup">
            <div class="logbox2">
                <div class="login">
                    <form class="login-form" id="register" method="POST">
                        @csrf
                        <div style="display: flex; flex-direction: row-reverse; margin-bottom: 2px; font-size: 20px;">
                            <label for="" class="endbtn fas fa-times"></label>
                        </div>
                        <div class="closed">
                            <div></div>
                            <div>
                                <p class="login-text">Register</p>
                            </div>
                            <div>
                                
                            </div>
                        </div>
                        <div id="error">
                        </div>
                        <div class="input-group">
                            <input type="username" placeholder="Username" name="username" id="username" required>
                        </div>
                        <div class="input-group">
                            <input type="email" placeholder="email" name="email" id="email" required>
                        </div>
                        <div class="input-group">
                            <input type="text" placeholder="Adderess" name="address" id="address" required>
                        </div>
                        <div class="input-group">
                            <input type="text" placeholder="Contact" name="contact" id="contact" required>
                        </div>
                        <div class="input-group">
                            <input type="password" placeholder="password" name="password" id="password" required>
                        </div>
                        
                        <div class="input-group">
                            <button class="logbtn" type="submit">Register</button>
                        </div>
                        <p class="login-register">Arleady have an account? <a href="#" id="Show_login">Login Here</a></p>
                    </form>
                </div>
            </div>
        </div>


        
        <script>
            $(document).ready(function(){
                $('#register').on("submit", function(e){
                    e.preventDefault();
                    let userData = $(this).serializeArray();
                    $.ajax({
                        url: "{{ url('/register') }}",
                        method: 'POST',
                        data: userData,
                        success: function(data){
                            if(data.errors){
                                $('#error').html('<p style="color: red !important">' + data.errors + '</p>');  
                            }
                            if(data.success){
                                document.getElementById('username').value = "";
                                document.getElementById('email').value = "";
                                document.getElementById('address').value = "";
                                document.getElementById('contact').value = "";
                                document.getElementById('password').value = "";
                                document.getElementById('popup').style.display = "none";
                            }
                            }
                        });
                    });
                });

                $(document).ready(function(){
                $('#login').on("submit", function(e){
                    e.preventDefault();
                    let userData = $(this).serializeArray();
                    $.ajax({
                        url: "{{ url('/login') }}",
                        method: 'POST',
                        data: userData,
                        success: function(data){
                            if(data.errors){
                                $('#login_error').html('<p style="color: red !important">' + data.errors + '</p>');  

                            }
                            if(data.success){
                               
                                document.getElementById('login_email').value = "";
                                document.getElementById('login_password').value = "";
                                document.getElementById('modal').style.display = "none";
                                if(data.success[1] == "admin"){
                                    window.location.href = "http://127.0.0.1:8000/admin/home";  
                                }
                                if(data.success[1] == "User"){
                                    window.location.href = "http://127.0.0.1:8000/";
                                }
                                if(data.success[1] == "driver"){
                                    window.location.href = "http://127.0.0.1:8000/assinedorder";
                                }
                            }
                            }
                        });
                    });
                });
        </script>

        <script>
            
            $("body").on("change", ".qty", function(e) {
                let id = $(this).attr('data-id');
                let quantity = $(this).val();
               
                $.ajax({
                    url : '/updatequantity',
                    type : 'POST',
                    data : {"id":id, "quantity":quantity, "_token":"{{ csrf_token() }}"},
                    success : function (response){
                        $('#cartstorage').html(response); 
                    }
                });
            });
        </script>
        
    </body> 
</html>