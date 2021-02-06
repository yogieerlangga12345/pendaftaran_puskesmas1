<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-success elevation-4">
  <!-- Brand Logo -->
  <a href="index3.html" class="brand-link">
    <img src="{{asset('asset/dist/img/puskesmas.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
    style="opacity: .8">
    <span class="brand-text font-weight-light"><b>Puskesmas</b> {{session('role')}}</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="{{asset('asset/dist/img/puskesmas.png')}}" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block">
          @if (session('role') == 'Admin')
              {{session('nama_admin')}}
          @elseif(session('role') == 'Petugas')
              {{session('nama_petugas')}}
               
          @elseif(session('role') == 'Dokter')
              {{session('nama_dokter')}}
          @else
              {{session('nama_pasien')}}
          @endif
        </a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
           with font-awesome or any other icon font library -->
           <li class="nav-item">
            <a href="{{route('dashboard')}}" class="nav-link @yield('dashboard_active')">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          @if(session('role') == 'Admin')
          <li class="nav-item has-treeview @yield('menu-admin')">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Master
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('master_admin')}}" class="nav-link @yield('admin-active')">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Admin</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{route('master_petugas')}}" class="nav-link @yield('petugas-active')">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Petugas</p>
                </a>
              </li>
{{-- 
              <li class="nav-item">
                <a href="{{route('master_dokter')}}" class="nav-link @yield('data_dokter-active')">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dokter</p>
                </a>
              </li> --}}

              <li class="nav-item">
                <a href="{{route('master_puskesmas')}}" class="nav-link @yield('puskesmas-active')">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Master Puskesmas</p>
                </a>
              </li>
            </ul>
          </li>
          @endif
          @if(session('role') == 'Pasien')
          <li class="nav-item">
            <a href="{{route('daftar_pasien')}}" class="nav-link @yield('daftar-active')">
              <i class="nav-icon fas fa-address-book"></i>
              <p>
                Daftar Pasien
              </p>
            </a>
          </li>
          @endif

          @if(session('role') == 'Petugas' || session('role')=='Admin')
           <li class="nav-item">
            <a href="{{route('data_pasien')}}" class="nav-link @yield('data-pasien-active')">
              <i class="nav-icon fas fa-hospital-user"></i>
              <p>
                Data Pasien
              </p>
            </a>
          </li>
          @endif
           @if(session('role') == 'Admin' || session('role')=='Petugas')
          <li class="nav-item">
            <a href="{{route('data_dokter')}}" class="nav-link @yield('data_dokter-active')">
              <i class="nav-icon fas fa-stethoscope"></i>
              <p>
                Data Dokter
              </p>
            </a>
          </li>
          @endif
           @if(session('role') == 'Admin' || session('role')=='Petugas')
          <li class="nav-item">
            <a href="{{route('jadwal_praktek')}}" class="nav-link @yield('jadwal_praktek-active')">
              <i class="nav-icon fas fa-calendar-alt"></i>
              <p>
                Jadwal Praktek Dokter
              </p>
            </a>
          </li>
           @endif

          @if(session('role') == 'Pasien' || session('role')=='Petugas')
          <li class="nav-item">
            <a href="{{route('laporan_pendaftaran')}}" class="nav-link @yield('laporan-active')">
              <i class="nav-icon fas fa-hospital"></i>
              <p>
                Laporan Pendaftaran
              </p>
            </a>
          </li>
          @endif

           @if(session('role') == 'Dokter')
          <li class="nav-item">
            <a href="{{route('halaman_dokter')}}" class="nav-link @yield('halaman-active')">
              <i class="nav-icon fas fa-hospital"></i>
              <p>
                Jadwal Praktek Dokter
              </p>
            </a>
          </li>
          @endif

          <li class="nav-item">
            <a href="{{route('login')}}" class="nav-link">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>
                Logout
              </p>
            </a>
          </li>

      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>