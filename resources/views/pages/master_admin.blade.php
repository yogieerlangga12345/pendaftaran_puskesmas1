@extends('welcome')
@section('menu-admin','menu-open')
@section('title','Master Admin')
@section('admin-active','active')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Master Admin</h3>
            </div>
            <div class="card-body">
                <button class="btn btn-success" data-toggle="modal" data-target="#Addadmin">
                    <i class="fas fa-plus"></i> Tambah Data
                </button>
                {{-- show data  --}}
                <table class="table table-hover table-striped" id="datatables">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Admin</th>
                            <th>Username</th>
                            <th>Password</th>
                            <th>No Telp</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no=1;
                            @endphp
                       @foreach ($db_admin as $admin)
                       <tr>
                       <td>{{$no++}}</td>
                       <td>{{$admin->nama_admin}}</td>
                       <td>{{$admin->username}}</td>
                       <td>{{$admin->password}}</td>
                       <td>{{$admin->nmr_telp}}</td>
                       <td> 
                           <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#Updateadmin" onclick="get_data({{$admin->id_admin}})">
                                <i class="fas fa-pencil-alt">
                                </i>
                                
                            </button>
                            <button class="btn btn-danger btn-sm" onclick="delete_data({{$admin->id_admin}})">
                                <i class="fas fa-trash">
                                </i>
                               
                            </button></td>
                       </tr>
                      
                    @endforeach
                        
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
</div>
<!-- modal add  -->
<div class="modal fade" id="Addadmin">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Data</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="save_admin" onsubmit="add_admin();return false;">
                    {{csrf_field()}}
                    <label class="form-group">Nama Admin</label>
                    <input type="text" class="form-control" name="nama_admin" id="nama_admin" required >
                        
                    <label class="form-group">Username</label>
                    <input type="text" class="form-control" name="username" id="username" required >
                       
                    <label class="form-group">Password</label>
                    <input type="text" class="form-control" name="password" id="password" required >

                    <label class="form-group">no telp</label>
                    <!-- <input type="text" class="form-control" name="nmr_telp" id="nmr_telp" required > -->
                    <input type="text" class="form-control" name="nmr_telp" id="nmr_telp" maxlength="15"
                                oninput="this.value = this.value.replace(/[^0-9+]/g, '').replace(/(\..*)\./g, '$1');"
                                required>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" >Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Edit Modal  -->
<div class="modal fade" id="Updateadmin">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Update Data</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="update_admin" onsubmit="update_admin();return false;">
                    {{csrf_field()}}
                    <input type="hidden" class="form-control" name="id_admin" id="update_id_admin" required>
                    <label class="form-group">Nama Admin</label>
                    <input type="text" class="form-control" name="nama_admin" id="update_nama_admin" required >
                        
                    <label class="form-group">Username</label>
                    <input type="text" class="form-control" name="username" id="update_username" required >
                       
                    <label class="form-group">Password</label>
                    <input type="text" class="form-control" name="password" id="update_password" required >

                    <label class="form-group">no telp</label>
                    <input type="text" class="form-control" name="nmr_telp" id="update_nmr_telp" maxlength="15"
                                oninput="this.value = this.value.replace(/[^0-9+]/g, '').replace(/(\..*)\./g, '$1');"
                                required>
                        
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" >Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- onclick="update_admin();" -->

@endsection
@section('js')
<script>
function show_loading() {
        Swal.fire({
            html: 'Waiting . . .',
            allowOutsideClick:false,
            onBeforeOpen: function() {
                Swal.showLoading()
            }
        });
    }

    function add_admin() {
        show_loading();
        $.ajax({
            headers:{
                'x-csrf-token': $('meta[name="csrf-token"]').attr('content')
            },
            url:"add-admin",
            processData:false,
            contentType:false,
            data:new FormData($('#save_admin')[0]),
            type:'post',
            method:'post'      
        }).done(function (data) {
            Swal.close();
                if (data == 'success') {
                    Swal.fire(
                        'success',
                        'tambah admin',
                        'success'
                    );
                    location.reload();
                }else{
                    Swal.fire(
                        'error',
                        'invalid form',
                        'error'
                    );
                }
        })
    }

    function get_data(id){
        show_loading();
        $.ajax({
            url : 'get-admin',
            method : 'get',
            data : {id:id}
        }).done(function(data){
            Swal.close();
            $('#update_id_admin').val(data[0].id_admin),
            $('#update_nama_admin').val(data[0].nama_admin),
            $('#update_username').val(data[0].username),
            $('#update_password').val(data[0].password),
            $('#update_nmr_telp').val(data[0].nmr_telp)
        })
    }

    function update_admin(){
        show_loading();
        $.ajax({
            headers:{
                'x-csrf-token': $('meta[name="csrf-token"]').attr('content')
            },
            url:"update-admin",
            processData:false,
            contentType:false,
            data:new FormData($('#update_admin')[0]),
            type:'post',
            method:'post'      
        }).done(function (data) {
            Swal.close();
                if (data == 'success') {
                    Swal.fire(
                        'success',
                        'update admin',
                        'success'
                    );
                    location.reload();
                }else{
                    Swal.fire(
                        'error',
                        'invalid form',
                        'error'
                    );
                }
        })
    }
    function delete_data(id) {
        Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.value) {
                        show_loading();
                        $.ajax({
                            url: 'delete-admin',
                            method : 'get',
                            data : {id:id}	
                        }).done(function (data) {
                            Swal.close();
                            if (data == 'success') {
                                Swal.fire(
                                    'success',
                                    'delete admin',
                                    'success'
                                    );
                                location.reload();
                            }else{
                                Swal.fire({
                                    icon: 'error',
                                    title: 'failed',
                                    text: 'your imaginary file is safe :)',
                                    showconfirmbutton: false,
                                    timer: 1500
                                })
                            }
                        })

                    }else{
                        Swal.fire({
                            icon: 'error',
                            title: 'failed',
                            text: 'your imaginary file is safe :)',
                            showconfirmbutton: false,
                            timer: 1500
                        })
                    }
                });
    }

</script>
@endsection