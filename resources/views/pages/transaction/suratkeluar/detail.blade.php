@extends('layout.main')
@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<nav aria-label="breadcrumb" class="d-flex justify-content-between">
  <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/suratkeluar">Surat Keluar</a></li>
      <li class="breadcrumb-item active" aria-current="page">Detail surat</li>
  </ol>
</nav>
<div class="row m-2 gap-2">
    <div class="card col-md-7">
        <div class="card-header border-bottom">
            <h5 class="m-0">Detail Surat</h5>
        </div>
        <div class="card-body row">
            <div class="col-md-5">
                <p class="card-text fw-bold">Nomor surat</p>
                <p class="card-text fw-bold">Pengirim</p>
                <p class="card-text fw-bold">Penerima</p>
                <p class="card-text fw-bold">Perihal</p>
                <p class="card-text fw-bold">Agenda</p>
                <p class="card-text fw-bold">Tanggal Event</p>
                <p class="card-text fw-bold">Lampiran</p>
            </div>
            <div class="col-md-4">
                <p class="card-text">{{ $letter->nomor_surat }}</p>
                <p class="card-text">{{ $letter->pengirim }}</p>
                <p class="card-text">{{ $letter->penerima->name }}</p>
                <p class="card-text">{{ $letter->perihal }}</p>
                <p class="card-text">{{ $letter->agenda }}</p>
                @php
                    use Carbon\Carbon;
                @endphp
                <p class="card-text">{{ Carbon::parse($letter->tanggal_event)->translatedFormat('d F Y') }}</p>
                <p class="card-text">
                    @if($letter->lampiran)
                        <a class="badge text-bg-secondary text-decoration-none" href="{{ asset('uploads/' . $letter->lampiran) }}" target="_blank">Lihat Lampiran</a>
                    @else
                        Tidak ada lampiran
                    @endif
                </p>
                <!-- Tombol Edit -->
                <a href="{{ route('editLetter', ['id' => $letter->id]) }}" class="btn btn-primary">Edit</a>
                <!-- Tombol Hapus -->
                <a class="btn btn-danger delete-btn" href="#" data-letter-id="{{ $letter->id }}">Hapus</a>

            </div>
        </div>
    </div>
    <div class="card col-md-4">
             <div class="card-header border-bottom">
                <h5 class="m-0">Lampiran</h5>
            </div>
                <div class="attachment-preview">
                    @if($letter->lampiran)
                        <iframe src="{{ asset('uploads/' . $letter->lampiran) }}" width="100%" height="400px"></iframe>
                    @else
                        <p>Tidak ada lampiran</p>
                    @endif
                </div>
            </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
  document.addEventListener('DOMContentLoaded', function () {
      const deleteButtons = document.querySelectorAll('.delete-btn');

      deleteButtons.forEach(button => {
          button.addEventListener('click', function (e) {
              e.preventDefault(); // Prevent default action (following the href)

              const letterId = this.getAttribute('data-letter-id');

              Swal.fire({
                  title: 'Konfirmasi',
                  text: 'Anda yakin ingin menghapus surat ini?',
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#d33',
                  cancelButtonColor: '#3085d6',
                  confirmButtonText: 'Ya, hapus!',
                  cancelButtonText: 'Batal'
              }).then((result) => {
                  if (result.isConfirmed) {
                      // Redirect to the delete route
                      window.location.href = '{{ route("deleteLetter", ["id" => ":id"]) }}'.replace(':id', letterId);
                  }
              });
          });
      });
  });
</script>


@endsection
