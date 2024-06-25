@extends('layout.main')
@section('content')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Pengiriman Surat</a></li>
        <li class="breadcrumb-item active" aria-current="page">Tambah Baru</li>
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
    <form class="row g-3" action="{{ route('surat.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
        
        <div class="col-md-6">
            <label for="pengirim" class="form-label">Pengirim</label>
            <input type="text" name="pengirim" class="form-control border ps-2" id="pengirim" value="{{ $name }}" readonly>
        </div>
        <div class="col-md-6 d-flex align-items-end flex-column">
        <label for="penerima" class="form-label align-self-start">Penerima</label>
        <select name="id_penerima" class="form-select form-control border ps-2" aria-label="Default select example">
            <option selected>Penerima</option>
            @if(auth()->user()->role == 'user')
                @foreach ($users as $user)
                    @if($user->name == 'GEMPA')
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endif
                @endforeach
            @else
                @foreach ($users as $user)
                    @if($user->id != auth()->user()->id)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endif
                @endforeach
            @endif
        </select>
        </div>
        <div class="col-md-4">
            <label for="noagenda" class="form-label">Nomor Surat</label>
            <input type="text" name="nomor_surat" class="form-control border ps-2" id="noagenda">
        </div>
        <div class="col-md-4">
            <label for="perihal" class="form-label">Perihal</label>
            <input type="text" name="perihal" class="form-control border ps-2" id="perihal">
        </div>
        <div class="col-md-4">
            <label for="agenda" class="form-label">Agenda</label>
            <input type="text" name="agenda" class="form-control border ps-2" id="agenda">
        </div>
        <div class="col-md-4">
            <label for="tglevent" class="form-label">Tanggal Event</label>
            <input type="date" name="tanggal_event" class="form-control border ps-2" id="tglevent">
        </div>
        
        <div class="col-md-8">
            <label for="perihal" class="form-label">Lampiran</label>
            <input name="lampiran" class="form-control form-control-sm" id="perihal" type="file">
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </form>
</div>

@endsection