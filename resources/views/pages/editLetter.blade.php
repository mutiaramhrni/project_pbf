@extends('layout.main')
@section('content')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#"></a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit Surat</li>
    </ol>
    <div class="card mb-4 p-4">
        @if($errors->any())
            <div class="alert alert-danger text-light">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if(session('success'))
            <div class="alert alert-success text-white">
                {{ session('success') }}
            </div>
        @endif
        <form class="row g-3" action="{{ route('surat.update', ['id' => $surat->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="col-md-6">
                <label for="pengirim" class="form-label">Pengirim</label>
                <input type="text" name="pengirim" class="form-control border ps-2" id="pengirim" value="{{ $surat->pengirim }}" readonly>
            </div>
            <div class="col-md-6 d-flex align-items-end flex-column">
                <label for="penerima" class="form-label align-self-start">Penerima</label>
                <select name="id_penerima" class="form-select form-control border ps-2" aria-label="Default select example">
                    <option value="{{ $surat->id_penerima }}" selected>{{ $surat->penerima->name }}</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label for="noagenda" class="form-label">Nomor Surat</label>
                <input type="text" name="nomor_surat" class="form-control border ps-2" id="noagenda" value="{{ $surat->nomor_surat }}">
            </div>
            <div class="col-md-4">
                <label for="perihal" class="form-label">Perihal</label>
                <input type="text" name="perihal" class="form-control border ps-2" id="perihal" value="{{ $surat->perihal }}">
            </div>
            <div class="col-md-4">
                <label for="agenda" class="form-label">Agenda</label>
                <input type="text" name="agenda" class="form-control border ps-2" id="agenda" value="{{ $surat->agenda }}">
            </div>
            <div class="col-md-4">
                <label for="tglevent" class="form-label">Tanggal Event</label>
                <input type="date" name="tanggal_event" class="form-control border ps-2" id="tglevent" value="{{ $surat->tanggal_event }}">
            </div>

            <div class="col-md-8">
                <label for="lampiran" class="form-label">Lampiran</label>
                @if($surat->lampiran)
                    <p>File saat ini: <a href="{{ asset('uploads/' . $surat->lampiran) }}" target="_blank">Lihat Lampiran</a></p>
                @endif
                <input name="lampiran" class="form-control form-control-sm" id="lampiran" type="file">
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a class="btn btn-primary" href="{{ route('letter.detail', ['id' => $surat->id]) }}">Kembali</a>
            </div>
        </form>
    </div>
@endsection
