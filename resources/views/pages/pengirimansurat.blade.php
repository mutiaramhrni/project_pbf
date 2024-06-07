@extends('layout.main')
@section('content')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Pengiriman Surat</a></li>
        <li class="breadcrumb-item active" aria-current="page">Tambah Baru</li>
    </ol>
    <div class="card mb-4 p-4">
    @if(session('success'))
        <div class="alert alert-success text-white">
            {{ session('success') }}
        </div>
    @endif
    <form class="row g-3" action="{{ route('surat.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
        
        <div class="col-md-6">
            <label for="pengirim" class="form-label">Pengirim</label>
            <input type="text" name="pengirim" class="form-control border ps-2" id="pengirim">
        </div>
        <div class="col-md-6">
            <label for="noagenda" class="form-label">Nomor Agenda</label>
            <input type="text" name="nomor_agenda" class="form-control border ps-2" id="noagenda">
        </div>
        <div class="col-md-6">
            <label for="tglevent" class="form-label">Tanggal Event</label>
            <input type="date" name="tanggal_event" class="form-control border ps-2" id="tglevent">
        </div>
        <div class="col-md-6">
            <label for="perihal" class="form-label">Perihal</label>
            <input type="text" name="perihal" class="form-control border ps-2" id="perihal">
        </div>
        <div class="col-md-12">
            <label for="file" class="form-label">Lampiran</label>
            <input type="file" name="filename[]" class="form-control border ps-2" id="file">
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
</form>
</div>

@endsection