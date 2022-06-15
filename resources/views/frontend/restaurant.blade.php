@extends('frontend.layouts.basic')

@section('main-container')

<div class="restaurant">
    <h1>All Restaurants</h1>
</div>

<section class="restaurants" id="restaurants">
            <div class="restaurant-content">

            @foreach($data as $data)
                <div class="box">
                   <a href="/restaurantmenu/{{$data->restaurantname}}" > <img class="image" src="{{URL::asset('/restaurantimage/'.$data->image)}}" alt=""></a>
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
        </section>

@endsection