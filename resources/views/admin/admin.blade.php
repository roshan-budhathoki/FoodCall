@extends('admin.adminlayout.adminmain', ['username' => session('username')])

@section('main-container')


            <div class="recent-grid">
                <div class="users">
                    <div class="card">
                        <div class="card-header">
                            <h2>User Lists</h2>
                        </div>
                        <div class="card-body" style="padding: 20px; overflow: scroll;">
                            <table width="100%">
                                <thead>
                                    <tr>
                                        <td>Customer Id</td>
                                        <td>Customer Name</td>
                                        <td>Adderess</td>
                                        <td>Email</td>
                                        <td>Contact</td>
                                        <td>Joining Date</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    @foreach($users as $user)
                                    <tr>
                                        <td><?php echo $i;?></td>
                                        <td>{{$user->username}}</td>
                                        <td>{{$user->adderess}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>{{$user->contact}}</td>
                                        <td>
                                            <span class="status"></span>
                                            {{$user->created_at->format('d M Y')}}
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
        </section>
</section>


        



        <!-- js file link -->
        <script src="../Javascript/admin.js"></script>
        <!-- <script src="../Javascript/script.js"></script> -->

</body>
</html>
@endsection
