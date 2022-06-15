@extends('admin.adminlayout.adminmain', ['username' => session('username')])

@section('main-container')

            
        <!----------------- Menu Grid--------------->
        <div class="recent-grid">
            <div class="users">
                <div class="card-tab">
                    <div class="card-header-tab">
                        
                        <div class="cardd-header">
                            <h2>Menu List</h2>
                            <button><a href="#" id="modalbtn">Add Menu</button></a>
                        </div>
                        
                        <div class="custom-select" style="width:200px;">
                            <select class="dropone" name="restaurantname">
                            <option value="Select a restaurants">Select a restaurants</option>
                            @foreach($dropdown as $dropdowns)
                                <option value="{{$dropdowns->restaurantname}}">{{$dropdowns->restaurantname}}</option>
                            @endforeach
                            </select>
                       
                        </div>
                       
                    </div>
                </div>
            </div>
            <div class="row" id="newmenu">


                <?php $i = 1; ?>
                @foreach($data as $data)
                <div class="cardd">
                    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
                        <div class="ms-card">
                            <div class="ms-card-img">
                                <img src="{{URL::asset('/menuimage/'.$data->image)}}" alt="">
                            </div>
                            <div class="ms-card-body">
                                <div class="new">
                                    <h6 class="mb-0">{{$data->productname}}</h6>
                                    <h6 class="ms-text-primary mb-0">Rs {{$data->price}}</h6>
                                </div>
                                <div class="new meta">
                                    <p>category: {{$data->category}}</p>
                                </div>
                                <div class="new mb-0">
                                    <button class="btn grid-btn mt-0 btn-sm btn-primary"><a href="{{url('/deletemenu',$data->id)}}">Remove</button></a>
                                    <button class="btn grid-btn mt-0 btn-sm btn-secondary"><a href="{{url('/editmenu',$data->id)}}">Edit</button></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php $i++; ?>
                @endforeach
            </div> 
        </div>

        <!---------------adding menu starts here----------------->
        <div class="modaal">
            <div class="popup">
                <form action="/addmenu" class="addmenu-form" id="addmenu" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="close-btn">&times;</div>
                        <div class="form">
                            <h2>Add Menu form</h2>
                            <div class="form-element">
                                <label class="name">Restaurant Name</label>
                                <select class="dropone" name="restaurant_name">
                                    <option value="0">Select a restaurant</option>
                                    @foreach($dropdown as $dropdowns)
                                        <option value="{{$dropdowns->restaurantname}}">{{$dropdowns->restaurantname}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-element">
                                <label class="name">Product Name</label>
                                <input type="text" name="productname" placeholder="Product Name" required>
                            </div>
                            <div class="form-element">
                                <label class="name">category</label>
                                <select class="dropone" name="category">
                                    <option value="0">Select a Category</option>
                                    <option value="Lunch">Lunch</option>
                                    <option value="Breakfast">Breakfast</option>
                                    <option value="Dinner">Dinner</option>

                                </select>
                            </div>
                            <div class="form-element">
                                <label class="name">Input Price</label>
                                <input type="num" name="price" placeholder="Price" required>
                            </div>
                            <div class="form-element">
                                <label class="name">Select Image</label>
                                <input type="file" name ="image" class="file-input" required>
                            </div>
                            <div class="form-element">
                                <button>Save Menu</button>
                            </div>
                        </div>
                </form>
            </div>
        </div>



        <!---------------------------------------- updating the menu ----------------------------->
        @if(session('editmenu'))
        
            <div class="updatmenu">
                <div class="updatepopmenu">
                <form action="{{url('/updatemenu', session('editmenu')->id )}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="popoutbtn">&times;</div>
                    <div class="form">
                            <h2>Edit Menu</h2>
                            <div class="form-element">
                                <label class="name">Restaurant Name</label>
                                <select  name="restaurant_name">
                                    <option value="0">Select a restaurant</option>
                                    @foreach($dropdown as $dropdowns)
                                        <option value="{{$dropdowns->restaurantname}}" {{$dropdowns->restaurantname == session('editmenu')['restaurantname'] ? "selected": ''}}>{{$dropdowns->restaurantname}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-element">
                                <label class="name">Product Name</label>
                                <input type="text" name="productname" value="{{session('editmenu')['productname']}}" placeholder="Product Name" required>
                            </div>
                            <div class="form-element">
                                <label class="name">category</label>
                                <select name="category">
                                    <option value="0">Select a Category</option>
                                    <option value="Lunch" {{session('editmenu')['category'] == "Lunch" ? "selected": ""}}>Lunch</option>
                                    <option value="Breakfast" {{session('editmenu')['category'] == "Breakfast" ? "selected": ""}}>Breakfast</option>
                                    <option value="Dinner" {{session('editmenu')['category'] == "Dinner" ? "selected": ""}}>Dinner</option>

                                </select>
                            </div>
                            <div class="form-element">
                                <label class="name">Input Price</label>
                                <input type="num" name="price" value="{{session('editmenu')['price']}}" placeholder="Price" required>
                            </div>
                            <div class="form-element">
                                <label class="name">Select Image</label>
                                <input type="file" name ="image" value="{{session('editmenu')['image']}}" class="file-input" required>
                                <p>{{session('editmenu')['image']}}</p>
                            </div>
                            <div class="form-element">
                                <button type="submit">Save Menu</button>
                            </div>
                        </div>
                </form>
                </div>
            </div>
        
        @endif



                
          


    </section>
</section>




        <!-- js file link -->
        <script src="../Javascript/admin.js"></script>

        <script>
            $('.dropone').change(function() {    
                var item=$(this);
                $.ajax({
                    url : "/getmenu",
                    method : "POST",
                    data : {
                        "_token" : "{{ csrf_token() }}",
                        restaurant_name : item.val()
                    }, 
                    success : function(response){
                        $("#newmenu").html(response);
                    }
                });
            });


            

        </script>

        <script>
            document.querySelector(".updatepopmenu .popoutbtn").addEventListener("click",function(){
                document.querySelector(".updatmenu").style.display="none";
            });  
        </script>

</body>
</html>

@endsection