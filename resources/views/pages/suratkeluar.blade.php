@extends('layout.main')
@section('content')
<nav aria-label="breadcrumb" class="d-flex justify-content-between">
  <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="#">Transaksi</a></li>
      <li class="breadcrumb-item active" aria-current="page">Surat Keluar</li>
  </ol>
  <div class="mx-3">
    <a href="#" class="btn bg-blue text-white">Tambah Baru</a>
</div>
</nav>
<div class="card mb-4">
  <div class="card-header pb-0">
      <div class="d-flex justify-content-between flex-column flex-sm-row">
          <div class="card-title">
              <h5 class="text-nowrap mb-0 fw-bold">B.001/GEMPA/IV/2024</h5>
              <small class="text-black">
                  <span class="text-secondary">{{ __('Penerima') }}:</span> HIMADA Pasaman |
                  <span class="text-secondary">{{ __('') }}</span> Undangan |
                  Pembukaan PCE
              </small>
          </div>
          <div class="card-title d-flex flex-row">
              <div class="d-inline-block mx-2 text-end text-black">
                  <small class="d-block text-secondary">{{ __('Tanggal Surat') }}</small>
                  24 April 2024
              </div>
              <div class="dropdown d-inline-block">
                  <button class="btn p-0" type="button" id="dropdown-incoming-123" data-bs-toggle="dropdown"
                          aria-haspopup="true" aria-expanded="false">
                      <i class="material-icons opacity-10">more_vert</i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown-incoming-123">
                      <a class="dropdown-item" href="#">Lihat</a>
                      <a class="dropdown-item" href="#">Edit</a>
                      <span class="dropdown-item cursor-pointer btn-delete">Hapus</span>
                  </div>
              </div>
          </div>
      </div>
  </div>
  <hr style="border-top: 2px solid #d9d9d9;">
  <div class="card-body">
      <p>Deskripsi surat</p>
      <div class="d-flex justify-content-between flex-column flex-sm-row">
          <small class="text-secondary">Catatan</small>
          <div>
              <a href="#" target="_blank"><i class="bx bxs-file-pdf display-6 cursor-pointer text-primary"></i></a>
              <a href="#" target="_blank"><i class="bx bxs-file-jpg display-6 cursor-pointer text-primary"></i></a>
              <a href="#" target="_blank"><i class="bx bxs-file-png display-6 cursor-pointer text-primary"></i></a>
          </div>
      </div>
  </div>
</div>
<div class="card mb-4">
  <div class="card-header pb-0">
      <div class="d-flex justify-content-between flex-column flex-sm-row">
        <div class="card-title">
          <h5 class="text-nowrap mb-0 fw-bold">B.001/GEMPA/IV/2024</h5>
          <small class="text-black">
              <span class="text-secondary">{{ __('Penerima') }}:</span> HIMADA Jambi |
              <span class="text-secondary">{{ __('') }}</span> Undangan |
              Pembukaan PCE
          </small>
      </div>
          <div class="card-title d-flex flex-row">
              <div class="d-inline-block mx-2 text-end text-black">
                  <small class="d-block text-secondary">{{ __('Tanggal Surat') }}</small>
                  15 April 2024
              </div>
              <div class="dropdown d-inline-block">
                  <button class="btn p-0" type="button" id="dropdown-incoming-123" data-bs-toggle="dropdown"
                          aria-haspopup="true" aria-expanded="false">
                      <i class="material-icons opacity-10">more_vert</i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown-incoming-123">
                      <a class="dropdown-item" href="#">Lihat</a>
                      <a class="dropdown-item" href="#">Edit</a>
                      <span class="dropdown-item cursor-pointer btn-delete">Hapus</span>
                  </div>
              </div>
          </div>
      </div>
  </div>
  <hr style="border-top: 2px solid #d9d9d9;">
  <div class="card-body">
      <p>Deskripsi surat</p>
      <div class="d-flex justify-content-between flex-column flex-sm-row">
          <small class="text-secondary">Catatan</small>
          <div>
              <a href="#" target="_blank"><i class="bx bxs-file-pdf display-6 cursor-pointer text-primary"></i></a>
              <a href="#" target="_blank"><i class="bx bxs-file-jpg display-6 cursor-pointer text-primary"></i></a>
              <a href="#" target="_blank"><i class="bx bxs-file-png display-6 cursor-pointer text-primary"></i></a>
          </div>
      </div>
  </div>
</div>
<div class="card mb-4">
  <div class="card-header pb-0">
      <div class="d-flex justify-content-between flex-column flex-sm-row">
        <div class="card-title">
          <h5 class="text-nowrap mb-0 fw-bold">B.001/GEMPA/IV/2024</h5>
          <small class="text-black">
              <span class="text-secondary">{{ __('Penerima') }}:</span> HIMADA Padang |
              <span class="text-secondary">{{ __('') }}</span> Undangan |
              Pembukaan PCE
          </small>
      </div>
          <div class="card-title d-flex flex-row">
              <div class="d-inline-block mx-2 text-end text-black">
                  <small class="d-block text-secondary">{{ __('Tanggal Surat') }}</small>
                  15 April 2024
              </div>
              <div class="dropdown d-inline-block">
                  <button class="btn p-0" type="button" id="dropdown-incoming-123" data-bs-toggle="dropdown"
                          aria-haspopup="true" aria-expanded="false">
                      <i class="material-icons opacity-10">more_vert</i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown-incoming-123">
                      <a class="dropdown-item" href="#">Lihat</a>
                      <a class="dropdown-item" href="#">Edit</a>
                      <span class="dropdown-item cursor-pointer btn-delete">Hapus</span>
                  </div>
              </div>
          </div>
      </div>
  </div>
  <hr style="border-top: 2px solid #d9d9d9;">
  <div class="card-body">
      <p>Deskripsi surat</p>
      <div class="d-flex justify-content-between flex-column flex-sm-row">
          <small class="text-secondary">Catatan</small>
          <div>
              <a href="#" target="_blank"><i class="bx bxs-file-pdf display-6 cursor-pointer text-primary"></i></a>
              <a href="#" target="_blank"><i class="bx bxs-file-jpg display-6 cursor-pointer text-primary"></i></a>
              <a href="#" target="_blank"><i class="bx bxs-file-png display-6 cursor-pointer text-primary"></i></a>
          </div>
      </div>
  </div>
</div>
<div class="card mb-4">
  <div class="card-header pb-0">
      <div class="d-flex justify-content-between flex-column flex-sm-row">
        <div class="card-title">
          <h5 class="text-nowrap mb-0 fw-bold">B.001/GEMPA/IV/2024</h5>
          <small class="text-black">
              <span class="text-secondary">{{ __('Penerima') }}:</span> HIMADA Pasaman |
              <span class="text-secondary">{{ __('') }}</span> Undangan |
              Pembukaan PCE
          </small>
      </div>
          <div class="card-title d-flex flex-row">
              <div class="d-inline-block mx-2 text-end text-black">
                  <small class="d-block text-secondary">{{ __('Tanggal Surat') }}</small>
                  15 April 2024
              </div>
              <div class="dropdown d-inline-block">
                  <button class="btn p-0" type="button" id="dropdown-incoming-123" data-bs-toggle="dropdown"
                          aria-haspopup="true" aria-expanded="false">
                      <i class="material-icons opacity-10">more_vert</i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown-incoming-123">
                      <a class="dropdown-item" href="#">Lihat</a>
                      <a class="dropdown-item" href="#">Edit</a>
                      <span class="dropdown-item cursor-pointer btn-delete">Hapus</span>
                  </div>
              </div>
          </div>
      </div>
  </div>
  <hr style="border-top: 2px solid #d9d9d9;">
  <div class="card-body">
      <p>Deskripsi surat</p>
      <div class="d-flex justify-content-between flex-column flex-sm-row">
          <small class="text-secondary">Catatan</small>
          <div>
              <a href="#" target="_blank"><i class="bx bxs-file-pdf display-6 cursor-pointer text-primary"></i></a>
              <a href="#" target="_blank"><i class="bx bxs-file-jpg display-6 cursor-pointer text-primary"></i></a>
              <a href="#" target="_blank"><i class="bx bxs-file-png display-6 cursor-pointer text-primary"></i></a>
          </div>
      </div>
  </div>
</div>
@endsection