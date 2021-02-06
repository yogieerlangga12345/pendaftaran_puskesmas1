@extends('welcome')
@section('menu-dokter','menu-open')
@section('title','Halaman Dokter')
@section('halaman-active','active')
@section('content')

 <div class="row">
    <div class="col-12">
        <div class="card">  
            <div class="card-header">
                <h3 class="card-title">Jadwal Yang Di Terima Dokter Hari ini</h3>
            </div>
         <div class="card-body">
                 <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#Addhaldokter">
                                   <i class="fas fa-file-pdf">
                                       Cetak PDF
                                   </i>
                            </button> 
                
            <div class="card-body">
                {{-- show data  --}}
                <table class="table table-hover table-striped" id="datatables">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>NIK</th>
                            <th>Nama Pasien</th>
                            <th>Umur</th>
                            <th>Sakit</th>
                            <th>Nomor Telepon</th>  
                            <th>Puskesmas</th>
                            <th>Nomor Antrian</th>
                            <th>Jam Praktek Dokter</th>
                            <th>Ruang Praktek</th>
                            <th>Tanggal Berobat</th>
                            <th>Action</th> 
                        </tr>
                    </thead>
                     <tbody>
                        @php
                            $no=1;
                            @endphp
                       @foreach ($dokter as $laporan)
                       <tr>
                       <td>{{$no++}}</td>
                       <td>{{$laporan->nik}}</td>
                       <td>{{$laporan->nama_pasien}}</td>
                       <td>{{$laporan->umur}}</td>
                       <td>{{$laporan->keluhan}}</td>
                       <td>{{$laporan->nmr_telp}}</td>
                       <td>{{$laporan->nama_puskesmas}}</td>
                       <td>{{$laporan->nmr_antrian}}</td>
                       <td>{{$laporan->jam_masuk}} - {{$laporan->jam_pulang}}</td>
                       <td>{{$laporan->ruang_praktek}}</td>
                       <td>{{$laporan->tanggal}}</td>
                       <td> 
                           @if($laporan->status == 1)
                         <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#UpdateDiagnosa" onclick="$('#update_id_daftar').val({{$laporan->id_daftar}})">
                                   <i class="fas fa-check">
                                   </i><br>
                            </button>
                            @endif
                     </td>
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
<div class="modal fade" id="Addhaldokter">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">laporan Dokter</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="save_haldokter" onsubmit="laporanDokter();return false;">
                    <label for="inputSpesialis3" class="col-sm-2 col-form-label">Puskes</label>
                    <select class="form-control select2" id="inputPuskesmas2" style="width: 100%;" required>
                    <option value="#" selected>Pilih Puskesmas</option>
                    @foreach($tempat3 as $tem3)
                    <option value="{{$tem3->id_tempat}}">{{$tem3->nama_puskesmas}}</option>
                    @endforeach
                    </select>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="">Tanggal Awal</label>
                            <input type="date" name="tanggal_awal1" id="tanggal_awal1" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label for="">Tanggal Akhir</label>
                            <input type="date" name="tanggal_akhir1" id="tanggal_akhir1" class="form-control" required>
                        </div>
                    </div>
                        
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" >Export PDF</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Modal  -->
<div class="modal fade" id="UpdateDiagnosa">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Update Data</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="update_diagnosa" onsubmit="update_diagnosa();return false;">
                    {{csrf_field()}}
                    <input type="hidden" class="form-control" name="id_daftar" id="update_id_daftar" required>
     
                    <label class="form-group">Diagnosa</label>
                    <input type="text" class="form-control" name="diagnosa" id="diagnosa" required >
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
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


    function add_data() {
        show_loading();
        $.ajax({
            headers:{
                'x-csrf-token': $('meta[name="csrf-token"]').attr('content')
            },
            url:"add-data",
            processData:false,
            contentType:false,
            data:new FormData($('#')[0]),
            type:'post',
            method:'post'      
        }).done(function (data) {
            Swal.close();
                if (data == 'success') {
                    Swal.fire(
                        'success',
                        'tambah Halaman Dokter',
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
     function laporanDokter() {
        // show_loading();
        var pus2 = document.getElementById("inputPuskesmas2").value;
        var first2 = document.getElementById("tanggal_awal1").value;
        var last2 = document.getElementById("tanggal_akhir1").value;

        if (first2 > last2) {
            Swal.fire('error','Tgl Awal Tidak Boleh Lebih Besar dari Tgl Akhir','error');
        }else{
           show_loading();
           $.ajax({
               url:'laporanDokter',
               data:{
                   pus2:pus2,
                   first2:first2,
                   last2:last2
               },
               method:"GET",
           }).done(function (data) {
                Swal.close();
                window.open("laporanDokter?pus2="+pus2+"&first2="+first2+"&last2="+last2,"_blank");
                location.reload();  
           })
        }
    }

    function get_data(id){
        show_loading();
        $.ajax({
            url : 'get-diagnosa',
            method : 'get',
            data : {id:id},
        }).done(function(data){
            Swal.close();
            $('#update_id_daftar').val(data[0].id_doftar);
            $('#update_diagnosa').val(data[0].diagnosa);
        })
    }

     function update_diagnosa(){
        show_loading();
        $.ajax({
            headers:{
                'x-csrf-token': $('meta[name="csrf-token"]').attr('content')
            },
            url:"update-diagnosa",
            processData:false,
            contentType:false,
            data:new FormData($('#update_diagnosa')[0]),
            type:'post',
            method:'post'      
        }).done(function (data) {
            Swal.close();
                if (data == 'success') {
                    Swal.fire(
                        'success',
                        'update diagnosa',
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