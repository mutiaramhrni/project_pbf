@php
    $user = Auth::user();
@endphp
<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-white"
    id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-dark opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href=" https://demos.creative-tim.com/material-dashboard/pages/dashboard "
            target="_blank">
            <img src="../assets/img/logo-gempa.png" class="navbar-brand-img h-100" alt="main_logo">
            <span class="ms-1 font-weight-bold text-dark">E-SURAT GEMPA</span>
        </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link {{ Request::is('/') ? 'text-white bg-blue' : 'text-dark' }}"
                    href="{{ url('/') }}">
                    <div class="text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">dashboard</i>
                    </div>
                    <span class="nav-link-text ms-1">Beranda</span>
                </a>
            </li>
            <li class="nav-item mt-3">
              <h6 class="ps-4 ms-2 text-uppercase text-xs text-dark font-weight-bolder opacity-8">Transaksi</h6>
          </li>
          
            @if(auth()->user()->role == 'sekum' || auth()->user()->role == 'user')
            <li class="nav-item">
                <a class="nav-link {{ Request::is('suratmasuk*') ? 'text-white bg-blue' : 'text-dark' }}"
                    href="{{ url('/suratmasuk') }}">
                    <div class="text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">inbox</i>
                    </div>
                    <span class="nav-link-text ms-1">Surat Masuk</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('suratkeluar*') ? 'text-white bg-blue' : 'text-dark' }}"
                    href="{{ url('/suratkeluar') }}">
                    <div class="text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">receipt_long</i>
                    </div>
                    <span class="nav-link-text ms-1">Surat Keluar</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('statussurat*') ? 'text-white bg-blue' : 'text-dark' }}"
                    href="{{ url('/statussurat') }}">
                    <div class="text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">hourglass_empty</i>
                    </div>
                    <span class="nav-link-text ms-1">Status Surat</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('pengirimansurat*') ? 'text-white bg-blue' : 'text-dark' }}"
                    href="{{ url('/pengirimansurat') }}">
                    <div class="text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">send</i>
                    </div>
                    <span class="nav-link-text ms-1">Pengiriman Surat</span>
                </a>
            </li>
            @endif
            @if(auth()->user()->role == 'ketum'|| auth()->user()->role == 'sekum')
            <li class="nav-item">
                <a class="nav-link {{ Request::is('approvals*') ? 'text-white bg-blue' : 'text-dark' }}"
                    href="{{ url('/approvals') }}">
                    <div class="text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">inbox</i>
                    </div>
                    <span class="nav-link-text ms-1">Approval Surat</span>
                </a>
            </li>
            @endif
            @if(auth()->user()->role == 'sekdept')
            <li class="nav-item">
                <a class="nav-link {{ Request::is('permintaansurat*') ? 'text-white bg-blue' : 'text-dark' }}"
                    href="{{ url('/permintaansurat') }}">
                    <div class="text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">send</i>
                    </div>
                    <span class="nav-link-text ms-1">Permintaan Surat</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('daftarrequest*') ? 'text-white bg-blue' : 'text-dark' }}"
                    href="{{ url('/daftarrequest') }}">
                    <div class="text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">receipt_long</i>
                    </div>
                    <span class="nav-link-text ms-1">Permintaan Terkirim</span>
                </a>
            </li>
            @endif
            @if(auth()->user()->role == 'sekum')
            <li class="nav-item">
                <a class="nav-link {{ Request::is('archive*') ? 'text-white bg-blue' : 'text-dark' }}"
                    href="{{ url('/archive') }}">
                    <div class="text-center me-2 d-flex align-items-center justify-content-center">
                      <i class="material-icons opacity-10">archive</i>
                    </div>
                    <span class="nav-link-text ms-1">Arsip Surat</span>
                </a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link {{ Request::is('permintaansekdept*') ? 'text-white bg-blue' : 'text-dark' }}"
                    href="{{ url('/permintaansekdept') }}">
                    <div class="text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">receipt_long</i>
                    </div>
                    <span class="nav-link-text ms-1">Daftar Permintaan</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('showMU*') ? 'text-white bg-blue' : 'text-dark' }}"
                    href="{{ url('/showMU') }}">
                    <div class="text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">person</i>
                    </div>
                    <span class="nav-link-text ms-1">Management user</span>
                </a>
            </li>
            @endif
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-dark font-weight-bolder opacity-8">Halaman Akun</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('profil*') ? 'text-white bg-blue' : 'text-dark' }}"
                    href="{{ url('/profil') }}">
                    <div class="text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">person</i>
                    </div>
                    <span class="nav-link-text ms-1">Profil</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link text-dark" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <div class="text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">logout</i>
                    </div>
                    <span class="nav-link-text ms-1">{{ __('Keluar') }}</span>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>
        </ul>
    </div>

</aside>
