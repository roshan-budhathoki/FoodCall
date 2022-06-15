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
