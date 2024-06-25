@extends('layout.main')
@section('content')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <nav aria-label="breadcrumb" class="d-flex justify-content-between">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Permintaan surat</li>
        </ol>
    </nav>

    <div class="row m-2 gap-2">
        <div class="card col-12">
            <div class="card-header border-bottom">
                <h5 class="m-0">Permintaan Terkirim</h5>
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
                          <th  scope="col">No</th>
                          <th scope="col">Penerima</th>
                          <th scope="col">Dikirim ke</th>
                          <th scope="col">Perihal</th>
                          <th scope="col">Agenda</th>
                          <th scope="col">Tanggal</th>
                          <th scope="col">Waktu</th>
                          <th scope="col">Tempat</th>
                          <th scope="col">Action</th>
                      </tr>
                  </thead>
                  <tbody>
                    @foreach($letters as $index => $letter)
                    <tr>
                        <td class="align-middle">{{ $index + 1 }}</td>
                        <td class="align-middle">{{ $letter->penerima }}</td>
                        <td class="align-middle">{{ $letter->send_to_name }}</td>
                        <td class="align-middle">{{ $letter->perihal }}</td>
                        <td class="align-middle">{{ $letter->agenda }}</td>
                        <td class="align-middle">{{ $letter->tanggal }}</td>
                        <td class="align-middle">{{ $letter->waktu }}</td>
                        <td class="align-middle">{{ $letter->tempat }}</td>
                        <td class="align-middle">
                        <a class="btn btn-danger delete-btn" href="#" data-letter-id="{{ $letter->id }}">Delete</a>
                        </td>
                    </tr>
                @endforeach
                
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
                                    window.location.href = '{{ route("deleteLetterPermintaan", ["id" => ":id"]) }}'.replace(':id', letterId);
                                }
                            });
                        });
                    });
                });
                </script>
                
                  </tbody>
              </table>
              
              
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+CVt/tI1VV8zD5wVu1K5ja0CTI69j" crossorigin="anonymous"></script>
@endsection
