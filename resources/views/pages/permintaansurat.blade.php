@extends('layout.main')
@section('content')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Permintaan Surat</a></li>
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
            <label for="penerima" class="form-label">Penerima</label>
            <input type="text" name="penerima" class="form-control border ps-2" id="penerima">
        </div>
        <div class="col-md-6">
            <label for="perihal" class="form-label">Perihal</label>
            <input type="text" name="perihal" class="form-control border ps-2" id="perihal">
        </div>
        <div class="col-md-6">
            <label for="agenda" class="form-label">Agenda</label>
            <input type="text" name="agenda" class="form-control border ps-2" id="agenda">
        </div>
        <div class="col-md-6">
            <label for="tgl" class="form-label">Tanggal</label>
            <input type="date" name="tanggal" class="form-control border ps-2" id="tgl">
        </div>
        <div class="col-md-6">
            <label for="waktu" class="form-label">Waku</label>
            <input type="time" name="waktu" class="form-control border ps-2" id="waktu">
        </div>
        <div class="col-md-6">
            <label for="tempat" class="form-label">tempat</label>
            <input type="text" name="tempat" class="form-control border ps-2" id="tempat">
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-primary">Request</button>
        </div>
</form>
</div>

@endsection