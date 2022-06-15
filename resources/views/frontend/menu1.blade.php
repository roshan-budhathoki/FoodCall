@extends('frontend.layouts.basic')

@section('main-container')
<?php var_dump($checks);?>
<div class="menu">
    <h1>{{$restaurant->restaurantname}}</h1>
        <div class="course-cap-bottom d-flex justify-content-between">
            <ul>
                <li><i class="fas fa-map-marker-alt"></i>&nbsp; {{$restaurant->location}} </li>
                <li><i class="fas fa-utensils"></i>&nbsp; {{$restaurant->foodtype}}</li>
            </ul>
        </div>
</div>

<section id="menu-list" class="section-padding">
    <div class="container-menu">
        <div class="row-menu">
            <div class="col-md-12 text-center" id="menu-filters">
                <ul>
                    <li><a class="filter active" data-filter=".menu-restaurant">Show All</a></li>
                    <li><a class="filter" href="#breakfast">Breakfast</a></li>
                    <li><a class="filter" href="#lunch">Lunch</a></li>
                    <li><a class="filter" href="#dinner">Dinner</a></li>
                </ul>
            </div>
            
            <section class="menu-cat" id="breakfast">
                <div class="menu-slider">
                    <div class="w" id="cartid">
                        <div class="slide">
                            <h3 class="menu-title">Breakfast</h3>
                            <div class="menu-container">
                            
                                @foreach($menus as $menu)
                                @if($menu->category == "Breakfast")  
                                
                                    <div class="menu-box">     
                                        <div class="info" style="display:flex">      
                                            <img src="{{URL::asset('/menuimage/'.$menu->image)}}" alt="">
                                            <div class="menu-info">
                                                <h3>{{$menu->productname}}</h3>
                                                <p>Rs {{$menu->price}}</p>
                                            </div>
                                        </div>
                                        <button class="add-cart" data-id="{{$menu->id}}" data-quantity="1"><i class="fas fa-plus-circle"></i></button>
                                    </div>
                                @endif
                                @endforeach  
                            </div>
                        </div>

                        <div class="slide" id="lunch">
                            <h3 class="menu-title">Lunch</h3>
                            <div class="menu-container">
                                @foreach($menus as $menu)
                                @if($menu->category == "Lunch")
                                
                                    <div class="menu-box">
                                        <div name="menudetail" class="info" style="display:flex">
                                            <img src="{{URL::asset('/menuimage/'.$menu->image)}}" alt="">
                                            <div class="menu-info">
                                                <h3>{{$menu->productname}}</h3>
                                                <p>Rs {{$menu->price}}</p>
                                            </div>
                                        </div>
                                        <button class="add-cart" data-id="{{$menu->id}}" data-quantity="1"><i class="fas fa-plus-circle"></i></button>
                                    </div> 
                                @endif
                                @endforeach 
                            </div>
                        </div>

                        <div class="slide" id="dinner">
                            <h3 class="menu-title">Dinner</h3>
                            <div class="menu-container">
                                @foreach($menus as $menu)
                                @if($menu->category == "Dinner")
                                    <div class="menu-box">
                                        <div class="info" style="display:flex">
                                            <img src="{{URL::asset('/menuimage/'.$menu->image)}}" alt="">
                                            <div class="menu-info">
                                                <h3>{{$menu->productname}}</h3>
                                                <p>Rs {{$menu->price}}</p>
                                            </div>
                                        </div>
                                        <button class="add-cart" data-id="{{$menu->id}}" data-quantity="1"><i class="fas fa-plus-circle"></i></button>
                                    </div>
                                @endif
                                @endforeach 
                            </div>
                        </div>
                    </div>
                </div>
            </section> 
        </form>
        </div>
    </div>
</section>

<script>
    $('.add-cart').on("click", function () {
        if (username == ""){
            $('#modal').show();
        }
        else{
            let menuid = $(this).attr('data-id');
            let productQuantity = $(this).attr("data-quantity");
            let path = "/addcart/"+ menuid;
            $.ajax({
                url : path,
                type : "POST",
                dataType : "JSON",
                data : {id: menuid, quantity : productQuantity, "_token":"{{ csrf_token() }}"},
                success : function (response) {
                    Snackbar.show({text: response.success, pos: 'top-left'});
                    $.ajax({
                            url : "/updatecart",
                            type : "POST",
                            data : {message : "I am data", "_token":"{{ csrf_token() }}"},
                            success : function (response){
                                $('#cartstorage').html(response); 
                            }
                        });
                        $.ajax({
                            url : "/cartsItem",
                            type : "POST",
                            data : {message : "I am data", "_token":"{{ csrf_token() }}"},
                            success : function (response){
                                $('.cartno').html(response); 
                            }
                        });       
                }
            });
        }
    });
    
</script>

@endsection
