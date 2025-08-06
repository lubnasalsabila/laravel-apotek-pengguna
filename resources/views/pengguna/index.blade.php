@extends('layouts.template')

@section('content')

    @if(Session::get('success'))
        <div class="alert alert-success">{{ Session::get('success') }}</div>
    @endif

    @if(Session::get('deleted'))
        <div class="alert alert-warning">{{ Session::get('deleted') }}</div>
    @endif

    <div class="d-flex justify-content-end mb-3">
        <a class="btn btn-secondary" href="{{ route('pengguna.create') }}">Tambah Pengguna</a>
    </div>

    <table class="table table-striped table-bordered table-hover">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Role</th>
                <th class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @php $no = 1; @endphp
            @foreach ($users as $item)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $item['name'] }}</td>
                    <td>{{ $item['email'] }}</td>
                    <td>{{ $item['role'] }}</td>
                    <td class="d-flex justify-content-center">
                        <a href="{{ route('pengguna.edit', $item['id']) }}" class="btn btn-primary me-3">Edit</a>

                        <!-- Tombol untuk memicu modal -->
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $item['id'] }}">
                            Hapus
                        </button>

                        <!-- Modal Hapus untuk masing-masing user -->
                        <div class="modal fade" id="deleteModal{{ $item['id'] }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $item['id'] }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteModalLabel{{ $item['id'] }}">Konfirmasi Hapus</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Apakah Anda yakin ingin menghapus pengguna <strong>{{ $item['name'] }}</strong>?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        <form action="{{ route('pengguna.delete', $item['id']) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Hapus</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End of Modal -->
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

@endsection
