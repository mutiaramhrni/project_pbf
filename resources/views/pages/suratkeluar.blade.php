@extends('layout.main')
@section('content')
    <nav aria-label="breadcrumb" class="d-flex justify-content-between">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Transaksi</a></li>
            <li class="breadcrumb-item active" aria-current="page">Surat Keluar</li>
        </ol>
    </nav>
    @foreach ($letters as $letter)
    <div class="card mb-4">
      <div class="card-header pb-0">
          <div class="d-flex justify-content-between flex-column flex-sm-row">
              <div class="card-title">
                  <a href="{{ route('letter.detail', ['id' => $letter->id]) }}" class="text-decoration-none d-block fs-5 text-nowrap mb-0 fw-bold">{{ $letter->nomor_surat }}</a>
                  <small class="text-black">
                      <span class="text-secondary">{{ __('Penerima') }}:</span> {{ $letter->penerima->name }} |
                      <span class="text-secondary">{{ __('Perihal') }}</span>: {{ $letter->perihal }} |
                      {{ $letter->agenda }}
                  </small>
              </div>
              <div class="card-title d-flex flex-row">
                  <div class="d-inline-block mx-2 text-end text-black">
                      <small class="d-block text-secondary">{{ __('Tanggal Surat') }}</small>
                      {{ $letter->tanggal_event }}
                  </div>
              </div>
          </div>
      </div>
      <hr style="border-top: 2px solid #d9d9d9;">
  </div>


  
    @endforeach
@endsection
