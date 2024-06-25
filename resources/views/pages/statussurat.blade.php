@extends('layout.main')
@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

<nav aria-label="breadcrumb" class="d-flex justify-content-between">
  <ol class="breadcrumb">
      <li class="breadcrumb-item active" aria-current="page">Status Surat</li>
  </ol>
</nav>

<div class="row m-2 gap-2">
    <div class="card col-12">
        <div class="card-header border-bottom">
            <h5 class="m-0">Status Surat</h5>
        </div>
        <div class="card-body">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nomor Surat</th>
                <th scope="col">Penerima</th>
                <th scope="col">Perihal</th>
                <th scope="col">Status</th>
                <th scope="col">Tanggal Event</th>
                <th scope="col">Lampiran</th>
            </tr>
        </thead>
        <tbody>
            @foreach($letters as $index => $letter)
                <tr>
                    <th scope="row">{{ $index + 1 }}</th>
                    <td>{{ $letter->nomor_surat }}</td>
                    <td>{{ $letter->penerima ? $letter->penerima->name : 'Tidak ada penerima' }}</td>
                    <td>{{ $letter->perihal }}</td>
                    <td>
                        @if($letter->approvals->isEmpty())
                            <span class="badge text-bg-warning">Pending</span>
                        @else
                            @foreach($letter->approvals as $approval)
                                <span class="badge text-bg-{{ $approval->status ? 'success' : 'danger' }}">
                                    {{ $approval->status ? 'Approved' : 'Rejected' }}
                                </span>
                            @endforeach
                        @endif
                    </td>
                    <td>{{ \Carbon\Carbon::parse($letter->tanggal_event)->translatedFormat('d F Y') }}</td>
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
    </div>
</div>

@endsection
