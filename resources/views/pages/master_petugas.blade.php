@extends('welcome')
@section('menu-petugas','menu-open')
@section('title','Master Petugas')
@section('petugas-active','active')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Master Petugas</h3>
            </div>
            <div class="card-body">
                <button class="btn btn-success" data-toggle="modal" data-target="#Addpetugas">
                    <i class="fas fa-plus"></i> Tambah Data
                </button>
                {{-- show data  --}}
                <table class="table table-hover table-striped" id="datatables">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Petugas</th>
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
                       @foreach ($db_petugas as $petugas)
                       <tr>
                       <td>{{$no++}}</td>
                       <td>{{$petugas->nama_petugas}}</td>
                       <td>{{$petugas->username}}</td>
                       <td>{{$petugas->password}}</td>
                       <td>{{$petugas->nmr_telp}}</td>
                       <td> 
                       
                       <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#Updatepetugas" onclick="get_data({{$petugas->id_petugas}})">
                                <i class="fas fa-pencil-alt">
                                </i>
                                
                            </button>
                            <button class="btn btn-danger btn-sm" onclick="delete_data({{$petugas->id_petugas}})">
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
<div class="modal fade" id="Addpetugas">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Data</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="save_petugas" onsubmit="add_petugas();return false;">
                    {{csrf_field()}}
                    <label class="form-group">Nama Petugas</label>
                    <input type="text" class="form-control" name="nama_petugas" id="nama_petugas" required >
                        
                    <label class="form-group">Username</label>
                    <input type="text" class="form-control" name="username" id="username" required >
                       
                    <label class="form-group">Password</label>
                    <input type="text" class="form-control" name="password" id="password" required >

                    <label class="form-group">no telp</label>
                   <!--  <input type="number" class="form-control" name="nmr_telp" id="nmr_telp" required > -->
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
<div class="modal fade" id="Updatepetugas">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Update Data</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="update_petugas" onsubmit="update_petugas();return false;">
                    {{csrf_field()}}
                    <input type="hidden" class="form-control" name="id_petugas" id="update_id_petugas" required>
                    <label class="form-group">Nama Petugas</label>
                    <input type="text" class="form-control" name="nama_petugas" id="update_nama_petugas" required >
                        
                    <label class="form-group">Username</label>
                    <input type="text" class="form-control" name="username" id="update_username" required >
                       
                    <label class="form-group">Password</label>
                    <input type="text" class="form-control" name="password" id="update_password" required >

                    <label class="form-group">no telp</label>
                    <!-- <input type="number" class="form-control" name="nmr_telp" id="update_nmr_telp" required > -->
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

    function add_petugas() {
        show_loading();
        $.ajax({
            headers:{
                'x-csrf-token': $('meta[name="csrf-token"]').attr('content')
            },
            url:"add-petugas",
            processData:false,
            contentType:false,
            data:new FormData($('#save_petugas')[0]),
            type:'post',
            method:'post'      
        }).done(function (data) {
            Swal.close();
                if (data == 'success') {
                    Swal.fire(
                        'success',
                        'tambah petugas',
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
            url : 'get-petugas',
            method : 'get',
            data : {id:id}
        }).done(function(data){
            Swal.close();
            $('#update_id_petugas').val(data[0].id_petugas),
            $('#update_nama_petugas').val(data[0].nama_petugas),
            $('#update_username').val(data[0].username),
            $('#update_password').val(data[0].password),
            $('#update_nmr_telp').val(data[0].nmr_telp)
        })
    }

    function update_petugas(){
        show_loading();
        $.ajax({
            headers:{
                'x-csrf-token': $('meta[name="csrf-token"]').attr('content')
            },
            url:"update-petugas",
            processData:false,
            contentType:false,
            data:new FormData($('#update_petugas')[0]),
            type:'post',
            method:'post'      
        }).done(function (data) {
            Swal.close();
                if (data == 'success') {
                    Swal.fire(
                        'success',
                        'update petugas',
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
                            url: 'delete-petugas',
                            method : 'get',
                            data : {id:id}	
                        }).done(function (data) {
                            Swal.close();
                            if (data == 'success') {
                                Swal.fire(
                                    'success',
                                    'delete petugas',
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