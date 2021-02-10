@extends('welcome')
@section('menu-dokter','menu-open')
@section('title','Master Dokter')
@section('dokter-active','active')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Master Dokter</h3>
            </div>
            <div class="card-body">
                <button class="btn btn-success" data-toggle="modal" data-target="#Addmdokter">
                    <i class="fas fa-plus"></i> Tambah Data
                </button>
                {{-- show data  --}}
                <table class="table table-hover table-striped" id="datatables">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Dokter</th>
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
                       @foreach ($db_dokter as $dokter)
                       <tr>
                       <td>{{$no++}}</td>
                       <td>{{$dokter->nama_dokter}}</td>
                       <td>{{$dokter->username}}</td>
                       <td>{{$dokter->password}}</td>
                       <td>{{$dokter->no_telp}}</td>
                       <td> 
                       
                       <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#Updatemdokter" onclick="mget_data({{$dokter->id_dokter}})">
                                <i class="fas fa-pencil-alt">
                                </i>
                                
                            </button>
                            <button class="btn btn-danger btn-sm" onclick="mdelete_data({{$dokter->id_dokter}})">
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
<div class="modal fade" id="Addmdokter">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Data</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="msave_dokter" onsubmit="madd_dokter();return false;">
                    {{csrf_field()}}
                    <label class="form-group">Nama Dokter</label>
                    <input type="text" class="form-control" name="nama_dokter" id="nama_dokter" required >
                        
                    <label class="form-group">Username</label>
                    <input type="text" class="form-control" name="username" id="username" required >
                       
                    <label class="form-group">Password</label>
                    <input type="text" class="form-control" name="password" id="password" required >

                    <label class="form-group">no telp</label>
                    <!-- <input type="number" class="form-control" name="no_telp" id="no_telp" required > -->
                    <input type="text" class="form-control" name="no_telp" id="no_telp" maxlength="15"
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
<div class="modal fade" id="Updatemdokter">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Update Data</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="mupdate_dokter" onsubmit="mupdate_dokter();return false;">
                    {{csrf_field()}}
                    <input type="hidden" class="form-control" name="id_dokter" id="update_id_dokter" required>
                    <label class="form-group">Nama Dokter</label>
                    <input type="text" class="form-control" name="nama_dokter" id="update_nama_dokter" required >
                        
                    <label class="form-group">Username</label>
                    <input type="text" class="form-control" name="username" id="update_username" required >
                       
                    <label class="form-group">Password</label>
                    <input type="text" class="form-control" name="password" id="update_password" required >

                    <label class="form-group">no telp</label>
                    <!-- <input type="number" class="form-control" name="no_telp" id="update_no_telp" required > -->
                    <input type="text" class="form-control" name="no_telp" id="update_no_telp" maxlength="15"
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

    function madd_dokter() {
        show_loading();
        $.ajax({
            headers:{
                'x-csrf-token': $('meta[name="csrf-token"]').attr('content')
            },
            url:"madd-dokter",
            processData:false,
            contentType:false,
            data:new FormData($('#msave_dokter')[0]),
            type:'post',
            method:'post'      
        }).done(function (data) {
            Swal.close();
                if (data == 'success') {
                    Swal.fire(
                        'success',
                        'tambah dokter',
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

    function mget_data(id){
        show_loading();
        $.ajax({
            url : 'mget-dokter',
            method : 'get',
            data : {id:id}
        }).done(function(data){
            Swal.close();
            $('#update_id_dokter').val(data[0].id_dokter),
            $('#update_nama_dokter').val(data[0].nama_dokter),
            $('#update_username').val(data[0].username),
            $('#update_password').val(data[0].password),
            $('#update_no_telp').val(data[0].no_telp)
        })
    }

    function mupdate_dokter(){
        show_loading();
        $.ajax({
            headers:{
                'x-csrf-token': $('meta[name="csrf-token"]').attr('content')
            },
            url:"mupdate-dokter",
            processData:false,
            contentType:false,
            data:new FormData($('#mupdate_dokter')[0]),
            type:'post',
            method:'post'      
        }).done(function (data) {
            Swal.close();
                if (data == 'success') {
                    Swal.fire(
                        'success',
                        'update dokter',
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
    function mdelete_data(id) {
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
                            url: 'mdelete-dokter',
                            method : 'get',
                            data : {id:id}	
                        }).done(function (data) {
                            Swal.close();
                            if (data == 'success') {
                                Swal.fire(
                                    'success',
                                    'delete dokter',
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