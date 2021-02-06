<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Data Pendaftaran</title>
    <style>
        .page-break {
        page-break-after: always;
    }
    @page {
        margin: 0cm 0cm;
    }
    body {
        margin-top: 2cm;
        margin-left: 2cm;
        margin-right: 2cm;
        margin-bottom: 2cm;
    }
    table {
        border-collapse: collapse;
    }
    .table {
        width: 100%;
        margin-bottom: 1rem;
        color: #212529;
    }
    .tables {
        width: 100%;
        margin-bottom: 1rem;
        color: #212529;
    }
    .tables td,
    .tables th {
        padding: .75rem;
        vertical-align: top;
        border-top: 0px solid #000000;
    }
    .tables thead th {
        vertical-align: bottom;
        border-bottom: 0px solid #000000;
    }
    .tables tbody+tbody {
        border-top: 0px solid #000000;
    }
    .table td,
    .table th {
        padding: .75rem;
        vertical-align: top;
        border-top: 1px solid #000000
    }
    .table thead th {
        vertical-align: bottom;
        border-bottom: 2px solid #000000
    }
    .table tbody+tbody {
        border-top: 2px solid #000000
    }
    .table-borderless tbody+tbody,
    .table-borderless td,
    .table-borderless th,
    .table-borderless thead th {
        border: 0
    }
    .custom-checkbox .custom-control-label::before {
        border-radius: .25rem;
    }
    label {
        display: inline-block;
        margin-bottom: .5rem;
    }
    body {
        font-size: 14px;
        font-family: Century;
    }
    th {
        text-align: inherit;
    }
    h4{
        margin:7px;
    }
    </style>
</head>
<body>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                     <div style="margin-left: 45%"> <img src="{{public_path().'/asset/dist/img/puskesmas.png'}}"  style="margin-right: 50%" width="65" height="87.5" style="padding-right: 5px;">
                    </div>
                    <h1 class="card-title" align="center" >Laporan Data Pendaftaran</h3>
                </div>
                    
                    <table class="table table-hover table-striped" border="1" id="datatables">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Pasien</th>
                                <th>NIK</th>
                                <th>Puskesmas</th>
                                <th>Alamat</th>
                                <th>Umur</th>
                                <th>No Telepon</th>
                                <th>Dokter</th>
                                <th>Ruang Praktek</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no=1;
                                @endphp
                           @foreach ($laporanPDF as $laporan)
                           <tr>
                           <td>{{$no++}}</td>
                           <td>{{$laporan->nama_pasien}}</td>
                           <td>{{$laporan->nik}}</td>
                           <td>{{$laporan->nama_puskesmas}}</td>
                           <td>{{$laporan->alamat}}</td>
                           <td>{{$laporan->umur}}</td>
                           <td>{{$laporan->nmr_telp}}</td>
                           <td>{{$laporan->nama_dokter}}</td>
                           <td>{{$laporan->ruang_praktek}}</td>
                              
                           </tr>
                          
                        @endforeach
                            
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
    
</body>
</html>