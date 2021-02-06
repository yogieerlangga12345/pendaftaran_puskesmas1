@extends('welcome')
@section('menu-daftar','menu-open')
@section('title','Laporan Pendaftaran')
@section('laporan-active','active')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">  
            <div class="card-header">
                <h3 class="card-title">Laporan Pendaftaran</h3>
            </div>
            <div class="card-body">
                 @if(session('role') == 'Petugas')
                 <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#Addlaporan">
                                   <i class="fas fa-file-pdf">
                                       CETAK PDF
                                   </i>
                            </button>
                 @endif           
            <div class="card-body">
                {{-- show data  --}}
                <table class="table table-hover table-striped" id="datatables">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Pasien</th>
                            <th>NIK</th>
                            <th>Puskesmas</th>
                            <th>Nomor Antrian</th>
                            <th>Dokter</th>
                            <th>Spesialis</th>
                            <th>Ruang Praktek</th>
                            <th>Tanggal Berobat</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                     <tbody>
                        @php
                            $no=1;
                            @endphp
                       @foreach ($laporan as $laporan)
                       <tr>
                       <td>{{$no++}}</td>
                       <td>{{$laporan->nama_pasien}}</td>
                       <td>{{$laporan->nik}}</td>
                       <td>{{$laporan->nama_puskesmas}}</td>
                       <td>{{$laporan->nmr_antrian}}</td>
                       <td>{{$laporan->nama_dokter}}</td>
                       <td>{{$laporan->spesialis}}</td>
                       <td>{{$laporan->ruang_praktek}}</td>
                       <td>{{$laporan->tanggal}}</td>
                       <td> 
                        <button class="btn btn-warning btn-sm" onclick="report_proses({{$laporan->id_daftar}})">
                                <i class="fas fa-eye">
                                </i>
                              
                            </button>   
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
<div class="modal fade" id="Addlaporan">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">laporan PDF</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="save_laporan" onsubmit="laporan_pdf();return false;">
                    <label for="inputSpesialis3" class="col-sm-2 col-form-label">Puskes</label>
                    <select class="form-control select2" id="inputPuskesmas1" style="width: 100%;" required>
                    <option value="#" selected>Pilih Puskesmas</option>
                    @foreach($tempat2 as $tem2)
                    <option value="{{$tem2->id_tempat}}">{{$tem2->nama_puskesmas}}</option>
                    @endforeach
                    </select>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="">Tanggal Awal</label>
                            <input type="date" name="tanggal_awal" id="tanggal_awal" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label for="">Tanggal Akhir</label>
                            <input type="date" name="tanggal_akhir" id="tanggal_akhir" class="form-control" required>
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

    function add_laporan() {
        show_loading();
        $.ajax({
            headers:{
                'x-csrf-token': $('meta[name="csrf-token"]').attr('content')
            },
            url:"add-laporan",
            processData:false,
            contentType:false,
            data:new FormData($('#save_laporan')[0]),
            type:'post',
            method:'post'      
        }).done(function (data) {
            Swal.close();
                if (data == 'success') {
                    Swal.fire(
                        'success',
                        'save laporan',
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
     function laporan_pdf() {
        // show_loading();
        var pus1 = document.getElementById("inputPuskesmas1").value;
        var first1 = document.getElementById("tanggal_awal").value;
        var last1 = document.getElementById("tanggal_akhir").value;

        if (first1 > last1) {
            Swal.fire('error','Tgl Awal Tidak Boleh Lebih Besar dari Tgl Akhir','error');
        }else{
           show_loading();
           $.ajax({
               url:'laporanPDF',
               data:{
                   pus1:pus1,
                   first1:first1,
                   last1:last1
               },
               method:"GET",
           }).done(function (data) {
                Swal.close();
                window.open("laporanPDF?pus1="+pus1+"&first1="+first1+"&last1="+last1,"_blank");
                location.reload();  
           })
        }
    }

</script>
@endsection