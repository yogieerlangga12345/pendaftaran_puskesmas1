<html>

<head>
    <title>Nomor Antrian</title>
</head>
@foreach ($qr as $p)
<body>
    <div style="margin: 0 auto; /* to make the div center align to the browser */
    padding: 20px;
    width: 370px;
    height: 330px;
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
        <hr style="border-top: 2px solid black;">
        <div class="row">
                       
            <div class="col-12" align="center" ><b style="font-family:roboto; font-size:25px;">Nomor Antrian</b></div>
            <div class="col-12" align="center" ><b style="font-family:roboto; font-size:70px;">{{$p->nmr_antrian}}</b></div>
            
            
        </div>
        <table style="font-family:arial">
            <hr style="width: 20%; border-top: 2px solid black;">
            <br>
            <tr>
                <td>Tanggal Berobat</td>
                <td>: {{\Carbon\Carbon::parse($p->tanggal)->isoFormat('dddd, DD / MMM / YYYY')}}</td>
            </tr>
            <tr>
                <td>Dokter</td>
                <td>: {{$p->nama_dokter}}</td>
            </tr>
            <tr>
                <td>Jam</td>
                <td>: {{$p->jam_masuk}} s/d {{$p->jam_pulang}}</td>
            </tr>
           
        </table>
        
        
    </div>
    @endforeach
</body>

</html>