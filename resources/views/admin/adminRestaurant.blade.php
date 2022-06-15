@extends('admin.adminlayout.adminmain', ['username' => session('username')])

@section('main-container')
          
        <!----------------- Restaurant lists--------------->
            <div class="recent-grid">
                <div class="users">
                    <div class="card">
                        <div class="card-header">
                            <h2>Restaurants list</h2>
                            <button><a href="#" id="resmodalbtn">Add Restaurants</button></a>
                        </div>
                        <div class="card-body" style="padding: 20px; overflow: scroll;">
                            <table width="100%" >
                                <thead>
                                    <tr>
                                        <td>Restaurant Id</td>
                                        <td>Restaurant Name</td>
                                        <td>Location</td>
                                        <td>Food Type</td>
                                        <td>Joining Date</td>
                                        <td>Edit/Delete</td>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php $i = 1; ?>
                                @foreach($data as $data)
                                    <tr>
                                        <td><?php echo $i;?></td>
                                        <td>{{$data->restaurantname}}</td>
                                        <td>{{$data->location}}</td>
                                        <td>{{$data->foodtype}}</td>
                                        <td>{{$data->created_at->format('d M Y')}}</td>
                                        <td>
                                            <a href="{{url('/editrestaurant',$data->id)}}">
                                                <i class="fas fa-pencil-alt text-secondary"></i>&nbsp;&nbsp;&nbsp;
                                            </a>
                                            <a href="{{url('/deleterestaurant',$data->id)}}">
                                                <i class="far fa-trash-alt ms-text-danger" ></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php $i++; ?>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>


<!--------------------------------- Adding restaurants ------------------------------>

            <div class="resmodaal" id="resadd">
                <div class="respopup">
                    <form action="/addrestaurant" class="addmenu-form" id="addres" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="closedbtn">&times;</div>
                            <div class="form">
                                <h2>Add Restaurant Form</h2>
                                <div class="form-element">
                                    <label class="name">Restaurant Name</label>
                                    <input type="text" name="restaurantname" placeholder="Restaurant Name" required>
                                </div>
                                <div class="form-element">
                                    <label class="name">Location</label>
                                    <input type="text" name="location" placeholder="Location" required>
                                </div>
                                <div class="form-element">
                                    <label class="name">Food Type</label>
                                    <input type="text" name="foodtype" placeholder="Food Type" required>
                                </div>
                                <div class="form-element">
                                    <label class="name">Select Image</label>
                                    <input type="file" name ="image" class="file-input" reqired>
                                </div>
                                <div class="form-element">
                                    <button>Save Restaurant</button>
                                </div>
                            </div>
                    </form>
                </div>
            </div>


            <!---------------------------------------- updating the restaurant ----------------------------->
            @if(session('editData'))
                <div class="updatemodal">
                    <div class="updatepop">
                        <form action="{{url('/updaterestaurant', session('editData')->id )}}"  method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="outbtn">&times;</div>
                                <div class="form">
                                    <h2>Update Restaurant</h2>
                                    <div class="form-element">
                                        <label class="name">Restaurant Name</label>
                                        <input type="text" name="restaurantname" value="{{session('editData')['restaurantname']}}" placeholder="Restaurant Name" required>
                                    </div>
                                    <div class="form-element">
                                        <label class="name">Location</label>
                                        <input type="text" name="location" value="{{session('editData')['location']}}" placeholder="Location" required>
                                            
                                    </div>
                                    <div class="form-element">
                                        <label class="name">Food Type</label>
                                        <input type="text" name="foodtype" value="{{session('editData')['foodtype']}}" placeholder="Food Type" required>
                                    </div>
                                    <div class="form-element">
                                        <label class="name">Select Image</label>
                                        <input type="file" name ="image" value="{{session('editData')['image']}}" class="file-input" required>
                                        <p>{{session('editData')['image']}}</p>
                                    </div>
                                    <div class="form-element">
                                        <button>Save Restaurant</button>
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
        <script src="../Javascript/read.js"></script>
        
    </body>
</html>

@endsection