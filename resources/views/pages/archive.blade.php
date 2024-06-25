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
                <div class="col-md-3">
                    <label for="date" class="form-label">Tanggal</label>
                    <input type="date" name="date" class="form-control border ps-2" id="date" value="{{ request('date') }}">
                </div>
                <div class="col-md-3">
                    <label for="month" class="form-label">Bulan</label>
                    <select name="month" class="form-select form-control border ps-2" id="month">
                        <option value="">Pilih Bulan</option>
                        @foreach(range(1, 12) as $month)
                            <option value="{{ $month }}" {{ request('month') == $month ? 'selected' : '' }}>
                                {{ Carbon::create()->month($month)->format('F') }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="year" class="form-label">Tahun</label>
                    <select name="year" class="form-select form-control border ps-2" id="year">
                        <option value="">Pilih Tahun</option>
                        @foreach(range(Carbon::now()->year, 2000) as $year)
                            <option value="{{ $year }}" {{ request('year') == $year ? 'selected' : '' }}>{{ $year }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="search" class="form-label">Cari</label>
                    <input type="text" name="search" class="form-control border ps-2" id="search" placeholder="Nomor surat / Pengirim / Perihal" value="{{ request('search') }}">
                </div>
                <div class="col-12">
                    <button type="submit" class="btn bg-blue text-white">Filter</button>
                    <a href="{{ route('archive') }}" class="btn btn-secondary">Reset</a>
                </div>
            </form>
        </div>
        
        <div class="card">
            <div class="card-header border-bottom">
                <h5 class="m-0">Arsip Surat</h5>
            </div>
            <div class="card-body">
                @if($letters->isEmpty())
                    <p class="text-center text-muted">Tidak ada surat untuk kriteria yang dipilih.</p>
                @else
                    <div class="table-responsive">
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
                                        <th scope="row">{{ $letters->firstItem() + $index }}</th>
                                        <td>{{ $letter->nomor_surat }}</td>
                                        <td>{{ $letter->pengirim }}</td>
                                        <td>{{ $letter->penerima ? $letter->penerima->name : 'Tidak ada penerima' }}</td>
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
                    </div>
                    <div class="d-flex justify-content-end mt-3">
                        {{ $letters->appends(request()->query())->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection