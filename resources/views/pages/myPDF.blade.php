<html>

<head>
    <title>Laporan Pendaftaran</title>
</head>
@foreach ($pasien as $p)
<body>
    <div style="margin: 0 auto; /* to make the div center align to the browser */
    padding: 20px;
    width: 500px;
    height: 600px;
    border-style: solid;
  
  ">
  <div style="margin: 0 auto; /* to make the div center align to the browser */">
        <table>
            <tr>
                <td><img src="{{public_path().'/asset/dist/img/puskesmas.png'}}" width="65" height="87.5" style="padding-right: 5px;"></td>
                <td>
                    <div class="row">
                        <div class="col-12" style="padding-bottom: 5px;"><b style="font-family:arial; font-size:20px;">{{$p->nama_puskesmas}}</b></div>
                        <div class="col-12"><a style="font-family:arial; font-size:15px;">{{$p->alamat_puskesmas}}</a></div>
                        <div class="col-12"><a style="font-family:arial; font-size:15px;">{{$p->alamat}}</a></div>
                        <div class="col-12"><a style="font-family:arial; font-size:15px;">Telp. {{$p->no_telp}}</a></div>
                    </div>
            </tr>



            </td>
            </tr>


        </table>
        <table style="font-family:arial">
            <hr style="border-top: 2px solid black;">
            <tr>
                <td>Nama</td>
                <td>: {{$p->nama_pasien}}</td>
            </tr>
            <tr>
                <td>NIK </td>
                <td>: {{$p->nik}}</td>
            </tr>
            <tr>
                <td>Nomor Antrian</td>
                <td>: {{$p->nmr_antrian}}</td>
            </tr>
            <tr>
                <td>Alamat </td>
                <td>: {{$p->alamat}}</td>
            </tr>
            <tr>
                <td>Kota </td>
                <td>: {{$p->tempat}}</td>
            </tr>
            <tr>
                <td>Tanggal Lahir</td>
                <td>: {{\Carbon\Carbon::parse($p->tanggal_lahir)->isoFormat('dddd, DD / MMM / YYYY')}}</td>
            </tr>
            <tr>
                <td>Nama Dokter</td>
                <td>: {{$p->nama_dokter}}</td>
            </tr>
            <tr>
                <td>Ruang Praktek</td>
                <td>: {{$p->ruang_praktek}}</td>
            </tr>
            <tr>
                <td>Tanggal Berobat</td>
                <td>: {{\Carbon\Carbon::parse($p->tanggal)->isoFormat('dddd, DD / MMM / YYYY')}}</td>
            </tr>
             <tr>
                <td>Keluhan Sakit</td>
                <td>: {{$p->keluhan}}</td>
            </tr>
            <tr>
                <td>Diagnosa</td>
                <td>: {{$p->diagnosa}}</td>
            </tr>
            
        </table>
        <hr style="border-top: 2px solid black;">
        <div class="row">
            <!--            
    	    <div class="col-12"><h2 style="font-family:roboto">LAPORAN PENDAFTARAN PUSKESMAS</h2></div> -->
            <div class="col-12" align="center" style="padding-bottom: 5px;padding-top: 5px;"><b><i style="font-family:arial;">Terimakasih Telah Melakukan Pendaftaran Puskesmas</i></b></div>
            </tr>

            <hr style="border-top: 2px solid black;">
        </div>
        <table align="right" class="tables" border="0" style="font-family:arial">
            <tr>
                <td width="50%"></td>
                <td width="50%">
                    {{\Carbon\Carbon::parse($p->tanggal)->isoFormat('dddd, DD / MMM / YYYY')}}
                </td>
            </tr>
            <tr>
                <td>
                    <br><br><br>

                </td>
                <td>
                    <br><br><br><br><br><b>{{$p->nama_dokter}}</b>
                    <hr style="border-top: 2px solid black;">FR/PUSK{{$p->id_daftar}},{{\Carbon\Carbon::parse($p->tanggal)->isoFormat('DD/MMM/gggg')}}
                    <br>
                </td>
            </tr>
        </table>
    </div>
     @endforeach
</body>

</html>