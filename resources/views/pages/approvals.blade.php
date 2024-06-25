@extends('layout.main')
@section('content')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <div class="container-fluid px-4">
        <nav aria-label="breadcrumb" class="mt-3">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">Approval Surat</li>
            </ol>
        </nav>

        <div class="card mt-3">
            <div class="card-header">
                <h5 class="m-0">Approval Surat</h5>
            </div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert text-white alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nomor Surat</th>
                                <th scope="col">Pengirim</th>
                                <th scope="col">Penerima</th>
                                <th scope="col">Perihal</th>
                                <th scope="col">Tanggal Event</th>
                                <th scope="col">Lampiran</th>
                                <th scope="col">Approval Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($letters as $index => $letter)
                                <tr>
                                    <th class="text-center" scope="row">{{ $index + 1 }}</th>
                                    <td>{{ $letter->nomor_surat }}</td>
                                    <td>{{ $letter->pengirim }}</td>
                                    <td>{{ $letter->penerima ? $letter->penerima->name : 'N/A' }}</td>
                                    <td>{{ $letter->perihal }}</td>
                                    <td>{{ \Carbon\Carbon::parse($letter->tanggal_event)->translatedFormat('d F Y') }}</td>
                                    <td>
                                        @if($letter->lampiran)
                                            <a class="badge bg-secondary text-decoration-none" href="{{ asset('uploads/' . $letter->lampiran) }}" target="_blank">Lihat Lampiran</a>
                                        @else
                                            <span class="badge bg-light text-dark">Tidak ada lampiran</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                      @php
                                          $latestApproval = $letter->approvals->last();
                                      @endphp
                                      @if($latestApproval)
                                          <span class="badge bg-{{ $latestApproval->status ? 'success' : 'danger' }}">
                                              {{ $latestApproval->status ? 'Approved' : 'Rejected' }}
                                          </span>
                                      @endif
                                  </td>
                                    <td>
                                        @if(Auth::user()->role == 'ketum')
                                            <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#approvalModal{{ $letter->id }}">Approve</button>
                                        @else
                                            <form action="{{ route('approve', $letter->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-success btn-sm">Approve</button>
                                            </form>
                                        @endif
                                        <form action="{{ route('reject', $letter->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-sm">Reject</button>
                                        </form>
                                    </td>
                                </tr>
                                
                                <!-- Modal for Approval -->
                                @if(Auth::user()->role == 'ketum')
                                    <div class="modal fade" id="approvalModal{{ $letter->id }}" tabindex="-1" aria-labelledby="approvalModalLabel{{ $letter->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="approvalModalLabel{{ $letter->id }}">Approve Surat</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form action="{{ route('approve', $letter->id) }}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label for="lampiran" class="form-label">Replace Lampiran (optional)</label>
                                                            <input type="file" name="lampiran" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-success">Approve</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+CVt/tI1VV8zD5wVu1K5ja0CTI69j" crossorigin="anonymous"></script>
@endsection
