@extends('welcome')
@section('menu-dokter','menu-open')
@section('title','Data Dokter')
@section('data_dokter-active','active')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Data Dokter</h3>
            </div>
            <div class="card-body">
                <button class="btn btn-success" data-toggle="modal" data-target="#Adddokter">
                    <i class="fas fa-plus"></i> Tambah Data
                </button>
                {{-- show data  --}}
                <table class="table table-hover table-striped" id="datatables">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Puskesmas</th>
                            <th>Username</th>
                            <th>Password</th>
                            <th>Nama Dokter</th>
                            <th>Spesialis</th>
                            <th>Hari</th>
                            <th>Ruang Praktek</th>
                            <th>Alamat</th>
                            <th>Jam</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no=1;
                            @endphp
                       @foreach ($tb_dokter as $dokter)
                       <tr>
                       <td>{{$no++}}</td>
                       <td>{{$dokter->nama_puskesmas}}</td>
                       <td>{{$dokter->username}}</td>
                       <td>{{$dokter->password}}</td>
                       <td>{{$dokter->nama_dokter}}</td>
                       <td>{{$dokter->spesialis}}</td>
                       <td>{{$dokter->hari}}</td>
                       <td>{{$dokter->ruang_praktek}}</td>
                       <td>{{$dokter->alamat}}</td>
                       <td>{{$dokter->jam_masuk}} - {{$dokter->jam_pulang}}</td>
                       <td> <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#Updatedokter" onclick="get_data({{$dokter->id_dokter}})">
                                <i class="fas fa-pencil-alt">
                                </i>
                                
                            </button>
                            <button class="btn btn-danger btn-sm" onclick="delete_data({{$dokter->id_dokter}})">
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
<div class="modal fade" id="Adddokter">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Data</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="save_dokter" onsubmit="add_dokter();return false;">
                    {{csrf_field()}}
                    <div class="form-group">
                    <label>Puskesmas</label>
                     <select class="form-control select2"  id="id_tempat" name="id_tempat" required style="width: 100%;">
                        <option value="" selected disabled>Pilih Puskesmas</option>
                         @foreach($tempat as $tem)
                        <option value="{{$tem->id_tempat}}">{{$tem->nama_puskesmas}}</option>
                        @endforeach
                    </select>
                       
                     <label class="form-group">Username</label>
                    <input type="text" class="form-control" name="username" id="username" required >
                      
                     <label class="form-group">Password</label>
                    <input type="text" class="form-control" name="password" id="password" required >
                      
                    <label class="form-group">Nama Dokter</label>
                    <input type="text" class="form-control" name="nama_dokter" id="nama_dokter" required >
                      
                 
                  <label>Spesialis</label>
                  <select class="form-control select2"  id="spesialis" name="spesialis" required style="width: 100%;">
                    <option selected="selected">Spesialis</option>
                    <option value="Dokter Umum">Dokter Umum</option>
                    <option value="Dokter Anak">Dokter Anak</option>
                    <option value="Dokter Gigi">Dokter Gigi</option>
                  </select>
               
                       
                    <label class="form-group">Alamat</label>
                    <input type="text" class="form-control" name="alamat" id="alamat" required >

                    <label class="form-group">Hari</label>
                    <input type="text" class="form-control" name="hari" id="hari" required >

                    <label class="form-group">Ruang Praktek</label>
                    <input type="text" class="form-control" name="ruang_praktek" id="ruang_praktek" required >

                    <label class="form-group">Jam</label>
                    <input type="time" class="form-control" name="jam_masuk" id="jam_masuk" required >

                    <label class="form-group">Jam</label>
                    <input type="time" class="form-control" name="jam_pulang" id="jam_pulang" required >
                        
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" >Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
<!-- Edit Modal  -->
<div class="modal fade" id="Updatedokter">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Update Data</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="update_dokter" onsubmit="update_dokter();return false;">
                    {{csrf_field()}}
                    <input type="hidden" class="form-control" name="id_dokter" id="update_id_dokter" required>

                     <select class="form-control select2"  id="update_id_tempat" name="id_tempat" required style="width: 100%;">
                        <option value="" selected disabled>Pilih Puskesmas</option>
                         @foreach($tempat as $tem)
                        <option value="{{$tem->id_tempat}}">{{$tem->nama_puskesmas}}</option>
                        @endforeach
                    </select>

                    <label class="form-group">Username</label>
                    <input type="text" class="form-control" name="username" id="update_username" required >
                      
                     <label class="form-group">Password</label>
                    <input type="text" class="form-control" name="password" id="update_password" required >

                   <label class="form-group">Nama Dokter</label>
                    <input type="text" class="form-control" name="nama_dokter" id="update_nama_dokter" required >

                   
                  <label>Spesialis</label>
                  <select class="form-control select2"  id="update_spesialis" name="spesialis" required style="width: 100%;">
                    <option selected="selected">Spesialis</option>
                    <option value="Dokter Umum">Dokter Umum</option>
                    <option value="Dokter Anak">Dokter Anak</option>
                    <option value="Dokter Gigi">Dokter Gigi</option>
                    <option value="Dokter Umum 2">Dokter Umum 2</option>
                    <option value="Dokter Gigi 2">Dokter Gigi 2</option>
                    <option value="Dokter Anak 2">Dokter Anak 2</option>
                    <option value="Dokter Umum 3">Dokter Umum 3</option>
                    <option value="Dokter Gigi 3">Dokter Gigi 3</option>
                    <option value="Dokter Anak 3">Dokter Anak 3</option>
                  </select>
                
                    <label class="form-group">Hari</label>
                    <input type="text" class="form-control" name="hari" id="update_hari" required >

                    <label class="form-group">Ruang Praktek</label>
                    <input type="text" class="form-control" name="ruang_praktek" id="update_ruang_praktek" required >

                    <label class="form-group">Alamat</label>
                    <input type="text" class="form-control" name="alamat" id="update_alamat" required >

                    <label class="form-group">Jam</label>
                    <input type="time" class="form-control" name="jam_masuk" id="update_jam_masuk" required >

                    <label class="form-group">Jam</label>
                    <input type="time" class="form-control" name="jam_pulang" id="update_jam_pulang" required >
                       
                    
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

    function add_dokter() {
        show_loading();
        $.ajax({
            headers:{
                'x-csrf-token': $('meta[name="csrf-token"]').attr('content')
            },
            url:"add-dokter",
            processData:false,
            contentType:false,
            data:new FormData($('#save_dokter')[0]),
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

    function get_data(id){
        show_loading();
        $.ajax({
            url : 'get-dokter',
            method : 'get',
            data : {id:id}
        }).done(function(data){
            Swal.close();
            $('#update_id_dokter').val(data[0].id_dokter),
            $('#update_id_tempat').val(data[0].id_tempat),
            $('#update_username').val(data[0].username),
            $('#update_password').val(data[0].password),
            $('#update_nama_dokter').val(data[0].nama_dokter),
            $('#update_spesialis').val(data[0].spesialis),
            $('#update_alamat').val(data[0].alamat),
            $('#update_hari').val(data[0].hari),
            $('#update_ruang_praktek').val(data[0].ruang_praktek),
            $('#update_jam_masuk').val(data[0].jam_masuk),
            $('#update_jam_pulang').val(data[0].jam_pulang)
            
        })
    }

    function update_dokter(){
        show_loading();
        $.ajax({
            headers:{
                'x-csrf-token': $('meta[name="csrf-token"]').attr('content')
            },
            url:"update-dokter",
            processData:false,
            contentType:false,
            data:new FormData($('#update_dokter')[0]),
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
                            url: 'delete-dokter',
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