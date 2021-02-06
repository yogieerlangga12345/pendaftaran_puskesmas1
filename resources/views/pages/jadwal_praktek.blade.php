@extends('welcome')
@section('menu-dokter','menu-open')
@section('title','Jadwal Praktek Dokter')
@section('dokter-active','active')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Jadwal Dokter</h3>
            </div>
            <div class="card-body">
                <button class="btn btn-success" data-toggle="modal" data-target="#Addjadwaldokter">
                    <i class="fas fa-plus"></i> Tambah Data
                </button>
                {{-- show data  --}}
                <table class="table table-hover table-striped" id="datatables">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Dokter</th>
                            <th>Spesialis</th>
                            <th>Hari</th>
                            <th>Ruang Praktek</th>
                            <th>Tanggal</th>
                            <th>Jam</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                       @php
                            $no=1;
                            @endphp
                       @foreach ($tb_jadwal_dokter as $jadwal)
                       <tr>
                       <td>{{$no++}}</td>
                       <td>{{$jadwal->nama_dokter}}</td>
                       <td>{{$jadwal->spesialis}}</td>
                       <td>{{$jadwal->hari}}</td>
                       <td>{{$jadwal->ruang_praktek}}</td>
                       <td>{{$jadwal->tanggal}}</td>
                       <td>{{$jadwal->jam_masuk}} - {{$jadwal->jam_pulang}} </td>
                       <td> <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#Updatejadwaldokter" onclick="get_data({{$jadwal->id_jadwal}})">
                                <i class="fas fa-pencil-alt">
                                </i>
                                
                            </button>
                            <button class="btn btn-danger btn-sm" onclick="delete_data({{$jadwal->id_jadwal}})">
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
<div class="modal fade" id="Addjadwaldokter">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Data</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="save_jadwaldokter" onsubmit="add_jadwaldokter();return false;">
                    {{csrf_field()}}
                    <label class="form-group">Nama Dokter</label>
                    <select class="form-control select2"  id="id_dokter" name="id_dokter" required style="width: 100%;">
                        <option value="" selected disabled>Pilih Dokter</option>
                         @foreach($dokter as $dok)
                        <option value="{{$dok->id_dokter}}">{{$dok->nama_dokter}}</option>
                        @endforeach
                    </select>
                        
                    <label class="form-group">Tanggal</label>
                    <input type="date" class="form-control" name="tanggal" id="tanggal" required >
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
<div class="modal fade" id="Updatejadwaldokter">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Update Data</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="update_jadwaldokter" onsubmit="update_jadwaldokter();return false;">
                    {{csrf_field()}}
                    <input type="hidden" class="form-control" name="id_jadwal" id="update_id_jadwal" required>

                   <label class="form-group">Nama Dokter</label>
                    <select class="form-control select2"  id="update_id_dokter" name="id_dokter" required style="width: 100%;">
                        <option value="" selected disabled>Pilih Dokter</option>
                         @foreach($dokter as $dok)
                        <option value="{{$dok->id_dokter}}">{{$dok->nama_dokter}}</option>
                        @endforeach
                    </select>
                        
                    <label class="form-group">Tanggal</label>
                    <input type="date" class="form-control" name="tanggal" id="update_tanggal" required >
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

    function add_jadwaldokter() {
        show_loading();
        $.ajax({
            headers:{
                'x-csrf-token': $('meta[name="csrf-token"]').attr('content')
            },
            url:"add-jadwaldokter",
            processData:false,
            contentType:false,
            data:new FormData($('#save_jadwaldokter')[0]),
            type:'post',
            method:'post'      
        }).done(function (data) {
            Swal.close();
                if (data == 'success') {
                    Swal.fire(
                        'success',
                        'tambah jadwal dokter',
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
            url : 'get-jadwaldokter',
            method : 'get',
            data : {id:id},
        }).done(function(data){
            Swal.close();
            $('#update_id_dokter').val(data[0].id_dokter);
            $('#update_id_jadwal').val(data[0].id_jadwal);
            $('#update_tanggal').val(data[0].tanggal);
        })
    }

    function update_jadwaldokter(){
        show_loading();
        $.ajax({
            headers:{
                'x-csrf-token': $('meta[name="csrf-token"]').attr('content')
            },
            url:"update-jadwaldokter",
            processData:false,
            contentType:false,
            data:new FormData($('#update_jadwaldokter')[0]),
            type:'post',
            method:'post'      
        }).done(function (data) {
            Swal.close();
                if (data == 'success') {
                    Swal.fire(
                        'success',
                        'update jadwal dokter',
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
                            url: 'delete-jadwaldokter',
                            method : 'get',
                            data : {id:id}	
                        }).done(function (data) {
                            Swal.close();
                            if (data == 'success') {
                                Swal.fire(
                                    'success',
                                    'delete jadwal dokter',
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