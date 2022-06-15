<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>FoodCall-Driver</title>

        <!-- font awesome cdn link-->
        <script src="https://kit.fontawesome.com/3228ac2f51.js" crossorigin="anonymous"></script>

        <!-- CSS file-->
        <link rel="stylesheet" href="{{URL::asset('/css/AdminMenu.css')}}">
        <link rel="stylesheet" href="{{URL::asset('/css/admin.css')}}">
        <link rel="stylesheet" href="{{URL::asset('/css/AdminRestaurant.css')}}">
        <link rel="stylesheet" href="{{URL::asset('/css/AdminOrderDetails.css')}}">
        <link rel="stylesheet" href="{{URL::asset('/css/addriver.css')}}">

        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js">
        </script>
        
    </head>

    <body>
        <div class="sidebar">
            <div class="logo-details">
                <i class="fas fa-utensils"></i>
                <span class="logo_name">FoodCall</span>
            </div>
            <ul class="nav-links">
                <li  
                style="<?php
                $link = "http" . "://" . 
                $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
                $checker = str_contains($link, "assinedorder") ? "background-color: #ec7474;":  "background-color: #ff3838;";
                echo $checker;
                ?>">
                    <a href="/assinedorder">
                        <i class="far fa-user"></i>
                        <span class="link-name">Assigned Orders</span>
                    </a>  
                </li>

                <li>
                    <form action="/logout" method = "POST">
                        @csrf
                        <button class="logout" type="submit">
                            <i class="fas fa-sign-out-alt"></i>
                            <span class="link-name">Logout</span>
                        </button> 
                    </form>    
                </li>
            </ul>
        </div>


        <!---------- home-section---------->

        <section class="home-section">
            <nav>
                <div class="sidebar-btn">
                    <i class="sidebarDash fas fa-bars "></i>  
                    <span class="dash">Driver Dashboard</span> 
                </div>
                <div class="profile">
                    <i class="far fa-user"></i>
                    <span class="admin-name">Driver</span>
                </div>
            </nav>
        
            

