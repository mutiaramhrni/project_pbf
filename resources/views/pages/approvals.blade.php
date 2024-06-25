@extends('layout.main')
@section('content')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <nav aria-label="breadcrumb" class="d-flex justify-content-between">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Approval Surat</li>
        </ol>
    </nav>

    <div class="row m-2 gap-2">
        <div class="card col-12">
            <div class="card-header border-bottom">
                <h5 class="m-0">Approval Surat</h5>
            </div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success text-white">
                        {{ session('success') }}
                    </div>
                @endif
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
                            <th scope="col">Approval Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($letters as $index => $letter)
                            <tr>
                                <th class="text-center align-middle" scope="row">{{ $index + 1 }}</th>
                                <td class="text-start align-middle">{{ $letter->nomor_surat }}</td>
                                <td class="text-start align-middle">{{ $letter->pengirim }}</td>
                                <td class="text-start align-middle">{{ $letter->penerima->name }}</td>
                                <td class="text-start align-middle">{{ $letter->perihal }}</td>
                                <td class="text-start align-middle">{{ \Carbon\Carbon::parse($letter->tanggal_event)->translatedFormat('d F Y') }}</td>
                                <td class="text-start align-middle">
                                    @if($letter->lampiran)
                                        <a class="badge text-bg-secondary text-decoration-none" href="{{ asset('uploads/' . $letter->lampiran) }}" target="_blank">Lihat Lampiran</a>
                                    @else
                                        Tidak ada lampiran
                                    @endif
                                </td>
                                <td class="text-center align-middle">
                                    @foreach($letter->approvals as $approval)
                                        <span class="badge text-bg-{{ $approval->status ? 'success' : 'danger' }}">
                                            {{ $approval->status ? 'Approved' : 'Rejected' }}
                                        </span>
                                    @endforeach
                                </td>
                                <td>
                                    <form action="{{ route('approve', $letter->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#approvalModal{{ $letter->id }}">Approve</button>
                                    </form>
                                    <form action="{{ route('reject', $letter->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm">Reject</button>
                                    </form>
                                </td>
                            </tr>
                            
                            <!-- Modal for Approval -->
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
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+CVt/tI1VV8zD5wVu1K5ja0CTI69j" crossorigin="anonymous"></script>
@endsection
