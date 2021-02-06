@extends('welcome')
@section('menu-daftar','menu-open')
@section('title','Daftar Pasien')
@section('daftar-active','active')
@section('content')
@if( $daftar == null)
<div class="card card-info">
  <div class="card-header">
    <h3 class="card-title">Pendaftaran Pasien</h3>
  </div>
  <!-- /.card-header -->
  <!-- form start -->
      
  <form class="form-horizontal" id="save_daftar" onsubmit="add_daftar();return false;">
    {{ csrf_field() }}
    <div class="card-body">
    <div class="row">
      <div class="col-md-6">
          <div class="form-group row">
            <label for="inputNama3" class="col-sm-2 col-form-label">Nama Pasien</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="inputNama3" placeholder="Nama Pasien" value="{{session('nama_pasien')}}" readonly required>
            </div>
          </div>

          <div class="form-group row">
            <label for="inputNIK3" class="col-sm-2 col-form-label">NIK</label>
            <div class="col-sm-10">
              <input type="number" class="form-control" id="inputNIK3" placeholder="NIK" value="{{session('nik')}}" readonly required>
            </div>
          </div>
          <div class="form-group row">
            <label for="inputAlamat3" class="col-sm-2 col-form-label">Alamat</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="inputAlamat3" placeholder="Alamat" name="alamat" required>
            </div>
          </div>

          <div class="form-group row">
            <label for="inputTTL3" class="col-sm-2 col-form-label">Tanggal Lahir</label>
            <div class="col-sm-10">
              <input type="date" class="form-control" id="inputTTL3" placeholder=" Tanggal Lahir" name="tanggal_lahir" required>
            </div>
          </div>
          
          <div class="form-group row">
            <label for="inputTTL3" class="col-sm-2 col-form-label">Tempat</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="inputTTL3" placeholder="Tempat" name="tempat" required>
            </div>
          </div>

      </div>
      <div class="col-md-6">
          <div class="form-group row">
            <label for="inputUmur3" class="col-sm-2 col-form-label">Umur</label>
            <div class="col-sm-10">
              <input type="number" class="form-control" id="inputUmur3" name="umur" placeholder="Umur" required>
            </div>
          </div>
          <div class="form-group row">
            <label for="inputNoTelpon3" class="col-sm-2 col-form-label">No Telepon</label>
            <div class="col-sm-10">
              <input type="number" class="form-control" id="inputNoTelpon3" placeholder="NoTelpon" value="{{session('nmr_telp')}}" readonly required>
            </div>
          </div>
           <div class="form-group row">
            <label for="inputSpesialis3" class="col-sm-2 col-form-label">Puskes</label>
            <div class="col-sm-10">
              <select class="form-control select2" onchange="cari_puskesmas();" id="inputPuskesmas" style="width: 100%;" required>
                <option value="#" selected>Pilih Puskesmas</option>
                @foreach($tempat as $tem)
                <option value="{{$tem->id_tempat}}">{{$tem->nama_puskesmas}}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label for="inputSpesialis3" class="col-sm-2 col-form-label">Spesialis</label>
            <div class="col-sm-10">
              <select class="form-control select2" onchange="cari_dokter();" id="inputDokter3" style="width: 100%;" required>
                <option value="#" selected>Spesialis</option>
                @foreach($dokter as $dok)
                <option value="{{$dok->id_dokter}}">{{$dok->spesialis}}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label for="inputtanggal3" class="col-sm-2 col-form-label">Tanggal Praktek</label>
            <div class="col-sm-10">
              <select class="form-control select2"  id="inputtanggal3" name="id_jadwal" style="width: 100%;" readonly required>
                <option value="" selected disabled>Tanggal</option>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label for="inputkeluhan" class="col-sm-2 col-form-label">Keluhan</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="inputkeluhan" placeholder="Keluhan" name="keluhan" required>
            </div>
          </div>
      </div>
    </div>
    </div>

    <!-- /.card-body -->
    <div class="card-footer">
      <button type="submit" class="btn btn-info">Simpan</button>
    </div>
    <!-- /.card-footer -->
  </form>
</div>
@endif
@if($last != null)
@if($last['status']==2)
<div class="card card-info">
  <div class="card-header">
    <h3 class="card-title">Pendaftaran Pasien</h3>
  </div>
 <form class="form-horizontal" id="save_daftar" onsubmit="add_daftar();return false;">
    {{ csrf_field() }}
    <div class="card-body">
    <div class="row">
      <div class="col-md-6">
          <div class="form-group row">
            <label for="inputNama3" class="col-sm-2 col-form-label">Nama Pasien</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="inputNama3" placeholder="Nama Pasien" value="{{session('nama_pasien')}}" readonly required>
            </div>
          </div>
          <div class="form-group row">
            <label for="inputNIK3" class="col-sm-2 col-form-label">NIK</label>
            <div class="col-sm-10">
              <input type="number" class="form-control" id="inputNIK3" placeholder="NIK" value="{{session('nik')}}" readonly required>
            </div>
          </div>
          <div class="form-group row">
            <label for="inputAlamat3" class="col-sm-2 col-form-label">Alamat</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="inputAlamat3" placeholder="Alamat" value="{{$last['alamat']}}" readonly name="alamat" required>
            </div>
          </div>
          <div class="form-group row">
            <label for="inputTTL3" class="col-sm-2 col-form-label">Tanggal Lahir</label>
            <div class="col-sm-10">
              <input type="date" class="form-control" id="inputTTL3" placeholder=" Tanggal Lahir" name="tanggal_lahir" value="{{$last['tanggal_lahir']}}" readonly required>
            </div>
          </div>
          <div class="form-group row">
            <label for="inputTTL3" class="col-sm-2 col-form-label">Tempat</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="inputTTL3" placeholder="Tempat" name="tempat" value="{{$last['tempat']}}" readonly required>
            </div>
          </div>

      </div>
      <div class="col-md-6">
          <div class="form-group row">
            <label for="inputUmur3" class="col-sm-2 col-form-label">Umur</label>
            <div class="col-sm-10">
              <input type="number" class="form-control" id="inputUmur3" name="umur" placeholder="Umur" value="{{$last['umur']}}" readonly required>
            </div>
          </div>
          <div class="form-group row">
            <label for="inputNoTelpon3" class="col-sm-2 col-form-label">No Telepon</label>
            <div class="col-sm-10">
              <input type="number" class="form-control" id="inputNoTelpon3" placeholder="NoTelpon" value="{{session('nmr_telp')}}" readonly required>
            </div>
          </div>
           <div class="form-group row">
            <label for="inputPuskesmas" class="col-sm-2 col-form-label">Puskes</label>
            <div class="col-sm-10">
              <select class="form-control select2" onchange="cari_puskesmas();" id="inputPuskesmas" style="width: 100%;" required>
                <option value="#" selected>Pilih Puskesmas</option>
                @foreach($tempat as $tem)
                <option value="{{$tem->id_tempat}}">{{$tem->nama_puskesmas}}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label for="inputSpesialis3" class="col-sm-2 col-form-label">Spesialis</label>
            <div class="col-sm-10">
              <select class="form-control select2" onchange="cari_dokter();" id="inputDokter3" style="width: 100%;" required>
                <option value="#" selected>Spesialis</option>
                @foreach($dokter as $dok)
                <option value="{{$dok->id_dokter}}">{{$dok->spesialis}}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label for="inputtanggal3" class="col-sm-2 col-form-label">Tanggal Praktek</label>
            <div class="col-sm-10">
              <select class="form-control select2"  id="inputtanggal3" name="id_jadwal" style="width: 100%;" readonly required>
                <option value="" selected disabled>Tanggal</option>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label for="inputkeluhan" class="col-sm-2 col-form-label">Keluhan</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="inputkeluhan" placeholder="Keluhan" name="keluhan" required>
            </div>
          </div>
      </div>
    </div>
    </div>

    <!-- /.card-body -->
    <div class="card-footer">
      <button type="submit" class="btn btn-info">Simpan</button>
    </div>
    <!-- /.card-footer -->
  </form>
  
</div>
@endif

@if ($last != null)
<div class="card">
  <div class="card-body">
    <div class="row">
      <div class="col">
        <div class="text-center">
          @if ($last['status'] == 0)
            <h1><i class="fas fa-spinner"></i></h1>
            <h1 class="tex">Waiting</h1> 
          @elseif($last['status'] == 1)
            <h1><i class="fas fa-check"></i></h1>
            <h1 class="tex">Terimakasih Telah Melakukan Pendaftaran Puskesmas</h1> 
            <h1>Nomor Antrian Anda Adalah : {{$last['nmr_antrian']}}</h1>
            
            {!! QrCode::size(250)->generate(url('/pdf-qr?id='.$last['id_daftar'])); !!}
          @endif
        </div>
      </div>
      </div>
    </div>
  </div>
</div>
@endif
@endif
@endsection
@section('js')
<script>
  function show_loading() {
    Swal.fire({
      html: 'Waiting . . .',
      allowOutsideClick: false,
      onBeforeOpen: function() {
        Swal.showLoading()
      }
    });
  }

  function cari_dokter() {
    show_loading();
    var id = $('#inputDokter3').val(); 
    var tempat = $('#inputPuskesmas').val();
    $.ajax({
      url: 'cari-dokter-pasien',
      method: 'GET',
      data: {
        id: id,
        tempat : tempat
      },
    }).done(function(data) {
      Swal.close();
      console.log(data);
      $('#inputtanggal3').html(data);
    })
  }

  function add_daftar() {
    show_loading();
    $.ajax({
      headers: {
        'x-csrf-token': $('meta[name="csrf-token"]').attr('content')
      },
      url: "add-daftar",
      processData: false,
      contentType: false,
      data: new FormData($('#save_daftar')[0]),
      type: 'post',
      method: 'post'
    }).done(function(data) {
      Swal.close();
      if (data == 'success') {
        Swal.fire(
          'success',
          'DAFTAR PASIEN',
          'success'
        );
        location.reload();
      } else {
        Swal.fire(
          'error',
          'invalid form',
          'error'
        );
      }
    })
  }
</script>
@endsection