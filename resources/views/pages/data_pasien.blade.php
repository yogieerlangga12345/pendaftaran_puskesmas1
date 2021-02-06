@extends('welcome')
@section('menu-daftar','menu-open')
@section('title','Riwayat Pasien')
@section('data-pasien-active','active')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Riwayat Pasien</h3>
            </div>
            <div class="card-body">
                 <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#Adddokter">
                                   <i class="fas fa-file-pdf">
                                       Cetak PDF
                                   </i>
                            </button>   
                
                <table class="table table-hover table-striped" id="datatables">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Pasien</th>
                            <th>NIK</th>
                            <th>Alamat</th>
                            <th>Umur</th>
                            <th>No Telepon</th>
                            <th>Puskesmas</th>
                            <th>Dokter</th>
                            <th>Ruang Praktek</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no=1;
                            @endphp
                       @foreach ($tb_daftar_pasien as $data_pasien)
                       <tr>
                       <td>{{$no++}}</td>
                       <td>{{$data_pasien->nama_pasien}}</td>
                       <td>{{$data_pasien->nik}}</td>
                       <td>{{$data_pasien->alamat}}</td>
                       <td>{{$data_pasien->umur}}</td>
                       <td>{{$data_pasien->nmr_telp}}</td>
                       <td>{{$data_pasien->nama_puskesmas}}</td>
                       <td>{{$data_pasien->nama_dokter}}</td>
                       <td>{{$data_pasien->ruang_praktek}}</td>
                       <td>
                        @if ($data_pasien->status == 0)
                           <span class="badge bg-warning">Waiting</span>
                       @elseif($data_pasien->status == 2)
                           <span class="badge bg-success">Done</span>
                        @else
                            <span class="badge bg-info">Operate</span>
                       @endif

                    </td>
                       <td>
                           @if ($data_pasien->status == 0)
                           <button class="btn btn-warning btn-sm" onclick="acc_data({{$data_pasien->id_daftar}},{{$data_pasien->id_jadwal}})">
                                   <i class="fas fa-check">
                                   </i>
                            </button>
                            @endif
                           
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
                <h4 class="modal-title">PDF</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="save_dokter" onsubmit="cetak_pdf();return false;">
                    <label for="inputSpesialis3" class="col-sm-2 col-form-label">Puskes</label>
                    <select class="form-control select2" id="inputPuskesmas" style="width: 100%;" required>
                    <option value="#" selected>Pilih Puskesmas</option>
                    @foreach($tempat as $tem)
                    <option value="{{$tem->id_tempat}}">{{$tem->nama_puskesmas}}</option>
                    @endforeach
                    </select>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="">Tanggal Awal</label>
                            <input type="date" name="tgl_awal" id="tgl_awal" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label for="">Tanggal Akhir</label>
                            <input type="date" name="tgl_akhir" id="tgl_akhir" class="form-control" required>
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

    function report_proses(idi){
        var id = idi;
        show_loading();
        window.open('laporan-pdf?id='+id,'_blank');
        Swal.close();
        location.reload();
    }

    function add_data_pasien() {
        show_loading();
        $.ajax({
            headers:{
                'x-csrf-token': $('meta[name="csrf-token"]').attr('content')
            },
            url:"add-data_pasien",
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
    function acc_data(id,jad){
        show_loading();
        $.ajax({
            url:"acc-data",
            method:'get',
            data:{id:id,jad:jad},    
        }).done(function (data) {
            Swal.close();
           if (data == 'success') {
               Swal.fire('success','success','success');
               location.reload();
           } else {
               Swal.fire('error','error','error');
           }
        })
    }

     function selesai(id,jad){
        show_loading();
        $.ajax({
            url:"selesai",
            method:'get',
            data:{id:id,jad:jad},    
        }).done(function (data) {
            Swal.close();
           if (data == 'success') {
               Swal.fire('success','success','success');
               location.reload();
           } else {
               Swal.fire('error','error','error');
           }
        })
    }

    function cetak_pdf() {
        // show_loading();
        var pus = document.getElementById("inputPuskesmas").value;
        var first = document.getElementById("tgl_awal").value;
        var last = document.getElementById("tgl_akhir").value;

        if (first > last) {
            Swal.fire('error','Tgl Awal Tidak Boleh Lebih Besar dari Tgl Akhir','error');
        }else{
           show_loading();
           $.ajax({
               url:'cetak-pdf-pasien',
               data:{
                   pus:pus,
                   first:first,
                   last:last
               },
               method:"GET",
           }).done(function (data) {
                Swal.close();
                window.open("cetak-pdf-pasien?pus="+pus+"&first="+first+"&last="+last,"_blank");
                location.reload();  
           })
        }
    }


</script>
@endsection