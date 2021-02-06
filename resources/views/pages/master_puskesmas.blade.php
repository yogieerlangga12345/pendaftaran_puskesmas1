@extends('welcome')
@section('menu-puskesmas','menu-open')
@section('title','Master Puskesmas')
@section('puskesmas-active','active')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Master Puskesmas</h3>
            </div>
            <div class="card-body">
                <button class="btn btn-success" data-toggle="modal" data-target="#Addpuskesmas">
                    <i class="fas fa-plus"></i> Tambah Data
                </button>
                {{-- show data  --}}
                <table class="table table-hover table-striped" id="datatables">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Puskesmas</th>
                            <th>Alamat</th>
                            <th>No Telp</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no=1;
                            @endphp
                       @foreach ($tb_tempat as $puskesmas)
                       <tr>
                       <td>{{$no++}}</td>
                       <td>{{$puskesmas->nama_puskesmas}}</td>
                       <td>{{$puskesmas->alamat_puskesmas}}</td>
                       <td>{{$puskesmas->no_telp}}</td>
                       <td> 
                       
                       <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#Updatepuskesmas" onclick="get_data({{$puskesmas->id_tempat}})">
                                <i class="fas fa-pencil-alt">
                                </i>
                                
                            </button>
                            <button class="btn btn-danger btn-sm" onclick="delete_data({{$puskesmas->id_tempat}})">
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
<div class="modal fade" id="Addpuskesmas">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Data</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="save_puskesmas" onsubmit="add_puskesmas();return false;">
                    {{csrf_field()}}
                    <label class="form-group">Puskesmas</label>
                    <input type="text" class="form-control" name="nama_puskesmas" id="nama_puskesmas" required >
                        
                    <label class="form-group">Alamat</label>
                    <input type="text" class="form-control" name="alamat_puskesmas" id="alamat_puskesmas" required >

                    <label class="form-group">No telp</label>
                    <input type="number" class="form-control" name="no_telp" id="no_telp" required >
                        
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
<div class="modal fade" id="Updatepuskesmas">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Update Data</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="update_puskesmas" onsubmit="update_puskesmas();return false;">
                    {{csrf_field()}}
                    <input type="hidden" class="form-control" name="id_tempat" id="update_id_tempat" required>
                     <label class="form-group">Puskesmas</label>
                    <input type="text" class="form-control" name="nama_puskesmas" id="update_nama_puskesmas" required >
                        
                    <label class="form-group">Alamat</label>
                    <input type="text" class="form-control" name="alamat_puskesmas" id="update_alamat_puskesmas" required >

                    <label class="form-group">No telp</label>
                    <input type="number" class="form-control" name="no_telp" id="update_no_telp" required >
                        
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

    function add_puskesmas() {
        show_loading();
        $.ajax({
            headers:{
                'x-csrf-token': $('meta[name="csrf-token"]').attr('content')
            },
            url:"add-puskesmas",
            processData:false,
            contentType:false,
            data:new FormData($('#save_puskesmas')[0]),
            type:'post',
            method:'post'      
        }).done(function (data) {
            Swal.close();
                if (data == 'success') {
                    Swal.fire(
                        'success',
                        'tambah puskesmas',
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
            url : 'get-puskesmas',
            method : 'get',
            data : {id:id}
        }).done(function(data){
            Swal.close();
            $('#update_id_tempat').val(data[0].id_tempat),
            $('#update_nama_puskesmas').val(data[0].nama_puskesmas),
            $('#update_alamat_puskesmas').val(data[0].alamat_puskesmas),
            $('#update_no_telp').val(data[0].no_telp)
        })
    }

    function update_puskesmas(){
        show_loading();
        $.ajax({
            headers:{
                'x-csrf-token': $('meta[name="csrf-token"]').attr('content')
            },
            url:"update-puskesmas",
            processData:false,
            contentType:false,
            data:new FormData($('#update_puskesmas')[0]),
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
                            url: 'delete-puskesmas',
                            method : 'get',
                            data : {id:id}	
                        }).done(function (data) {
                            Swal.close();
                            if (data == 'success') {
                                Swal.fire(
                                    'success',
                                    'delete puskesmas',
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