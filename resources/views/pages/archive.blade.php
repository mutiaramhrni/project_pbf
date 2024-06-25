@extends('layout.main')
@section('content')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    @php
        use Carbon\Carbon;
    @endphp

    <nav aria-label="breadcrumb" class="d-flex justify-content-between">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Arsip Surat</li>
        </ol>
    </nav>

    <div class="container mx-auto p-4">
        <div class="card mb-4 p-4">
            <form class="row g-3" action="{{ route('archive') }}" method="GET">
                <div class="col-md-4">
                    <label for="date" class="form-label">Tanggal</label>
                    <input type="date" name="date" class="form-control border ps-2" id="date">
                </div>
                <div class="col-md-4">
                    <label for="month" class="form-label">Bulan</label>
                    <select name="month" class="form-select form-control border ps-2" id="month">
                        <option value="" selected>Bulan</option>
                        @foreach(range(1, 12) as $month)
                            <option value="{{ $month }}">{{ Carbon::create()->month($month)->format('F') }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="year" class="form-label">Tahun</label>
                    <select name="year" class="form-select form-control border ps-2" id="year">
                        <option value="" selected>Tahun</option>
                        @foreach(range(Carbon::now()->year, 2000) as $year)
                            <option value="{{ $year }}">{{ $year }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn bg-blue text-white">Filter</button>
                </div>
            </form>
        </div>
        
        <div class="card">
            <div class="card-header border-bottom">
                <h5 class="m-0">Arsip Surat</h5>
            </div>
            <div class="card-body">
                @if($letters->isEmpty())
                    <p class="text-center text-muted">Tidak ada surat untuk tanggal yang dipilih.</p>
                @else
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nomor Surat</th>
                                <th scope="col">Pengirim</th>
                                <th scope="col">Penerima</th>
                                <th scope="col">Perihal</th>
                                <th scope="col">Tanggal Event</th>
                                <th scope="col">Lampiran</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($letters as $index => $letter)
                                <tr>
                                    <th class="text-center align-middle" scope="row">{{ $index + 1 }}</th>
                                    <td>{{ $letter->nomor_surat }}</td>
                                    <td>{{ $letter->pengirim }}</td>
                                    <td>{{ $letter->penerima->name }}</td>
                                    <td>{{ $letter->perihal }}</td>
                                    <td>{{ Carbon::parse($letter->tanggal_event)->translatedFormat('d F Y') }}</td>
                                    <td>
                                        @if($letter->lampiran)
                                            <a class="badge text-bg-secondary text-decoration-none" href="{{ asset('uploads/' . $letter->lampiran) }}" target="_blank">Lihat Lampiran</a>
                                        @else
                                            Tidak ada lampiran
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
@endsection
