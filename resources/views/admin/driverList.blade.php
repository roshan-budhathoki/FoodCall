@extends('admin.adminlayout.adminmain', ['username' => session('username')])

@section('main-container')


<!----------------- Driver lists--------------->
<div class="recent-grid">
    <div class="users">
        <div class="card">
            <div class="card-header">
                <h2>Driver list</h2>
            </div>
            <div class="card-body" style="padding: 20px; overflow: scroll;">
                <table width="100%" >
                    <thead>
                        <tr>
                            <td>Driver Id</td>
                            <td>Driver Name</td>
                            <td>Address</td>
                            <td>Contact</td>
                            <td>Email</td>
                            <td>Lisence Number</td>
                            <td>Password</td>
                        </tr>
                    </thead>
                    <tbody>


                        <?php $i = 1; ?>
                        @foreach($data as $data)
                        <tr>
                            <td><?php echo $i;?></td>
                            <td>{{$data->username}}</td>
                            <td>{{$data->adderess}}</td>
                            <td>{{$data->contact}}</td>
                            <td>{{$data->email}}</td>
                            <td>{{$data->lisenceNumber}}</td>
                            <td>{{$data->password}}</td>
                        </tr>
                        <?php $i++; ?>
                        @endforeach
                           
                        
                        
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>






</section>
</section>

<!-- js file link -->
<script src="../Javascript/admin.js"></script>
<script src="../Javascript/read.js"></script>

</body>
</html>

@endsection