@extends('frontend.layouts.main')

@section('main-container')

        <!-----------------Home section starts here--------------->
        <section class="home" id="home">
            <div class="content">
                <h3><b>Food</b> you love,</h3>
                <h3><b>Delivered</b> to you.</h3>
                <a href="#" class="btn">Order now</a>
            </div>
            <div class="image">
                <img src="../Image/home.png" alt="">
            </div>

        </section>
        <!-----------------Home section ends here----------------->


        <!----------------Restaurants section starts here--------------->
        <section class="restaurants" id="restaurants">
            <h1 class="heading">Our <span>Restaurants</span></h1>
            <div class="box-container">
            @foreach($restaurants as $data)
                <div class="box">
                    <a href="/restaurantmenu/{{$data->restaurantname}}"><img class="image" src="{{URL::asset('/restaurantimage/'.$data->image)}}" alt=""></a>
                    <h3>{{$data->restaurantname}}</h3>
                    <div class="course-cap-bottom d-flex justify-content-between">
                        <ul>
                            <li><i class="fas fa-map-marker-alt"></i>&nbsp; {{$data->location}}</li>
                            <li><i class="fas fa-utensils"></i>&nbsp; {{$data->foodtype}}</li>
                        </ul>
                    </div>
                </div>
            @endforeach
            </div>
            <div class="button">
                <a href="/restaurant" class="btn">View More</a>
            </div>
        </section>
        <!----------------Restaurants section ends here--------------->



        <!----------------Popular offers section starts here--------------->
        <section class="offers" id="offers">
            <h1 class="heading">Popular <span>Offers</span></h1>
            <div class="box-container">
                <div class="box">
                    <span class="rate"> Rs 1000 </span>
                    <img src="../Image/offer1.jpg">
                    <h3>Tasty Burger</h3>
                    <a href="#" class="btn">Order Now</a>
                </div>
                <div class="box">
                    <span class="rate"> Rs 1000 </span>
                    <img src="../Image/offer2.jpg">
                    <h3>Tasty Burger</h3>
                    <a href="#" class="btn">Order Now</a>
                </div>
                <div class="box">
                    <span class="rate"> Rs 1000 </span>
                    <img src="../Image/offer3.jpg">
                    <h3>Tasty Burger</h3>
                    <a href="#" class="btn">Order Now</a>
                </div>
                <div class="box">
                    <span class="rate"> Rs 1000 </span>
                    <img src="../Image/offer4.jpg">
                    <h3>Tasty Burger</h3>
                    <a href="#" class="btn">Order Now</a>
                </div>
                <div class="box">
                    <span class="rate"> Rs 1000 </span>
                    <img src="../Image/offer5.jpg">
                    <h3>Tasty Burger</h3>
                    <a href="#" class="btn">Order Now</a>
                </div>
                <div class="box">
                    <span class="rate"> Rs 1000 </span>
                    <img src="../Image/offer6.jpg">
                    <h3>Tasty Burger</h3>
                    <a href="#" class="btn">Order Now</a>
                </div>
            </div>
        </section>
        <!----------------Popular offers section starts here--------------->



        <!----------------About us section starts here--------------->
        <section class="about" id="about">
            
                <h1 class="head">About <span>Us</span></h1>
            
            <div class="aboutus">
                <div class="image">
                    <img src="../Image/about3.png" alt="about">
                </div>
                <div class="content description">
                    <h3><span>Order</span> anytime and anywhere</h3>
                    <pre></pre><p>
                    FoodCall is the fastest, easiest and most convenient way to enjoy the best food of your favourite
                    restaurants at home, at the office or wherever you want to.
                    </p>
                    <br>
                    <br>
                    <p>
                    We know that your time is valuable and sometimes every minute in the day counts.<br> That’s why we
                    deliver! So you can spend more time doing the things you love.
                </pre></p>

                    <a href="#" class="btn">Learn More</a>
                </div> 
            </div>
        </section>
         <!----------------About us section ends here--------------->




 

 @endsection