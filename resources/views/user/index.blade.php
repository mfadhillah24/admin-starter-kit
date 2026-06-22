<x-app>

    <x-slot:title>{{ $title }}</x-slot>

    <div class="card shadow p-3">
        <h5 class="fw-bold mb-0">{{ $title }}</h5>
    </div>

    <div class="card shadow p-3">
        <div>
            <a href="{{ route('user.create') }}" class="btn btn-primary mb-3">Create</a>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-hover w-100" id="data-table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Email</th>
                        <th scope="col">Role</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->role }}</td>

                            <td class="text-nowrap">
                                <a href="{{ route('user.edit', $user->id) }}" class="btn btn-warning btn-sm"><i class='bx bx-edit-alt'></i></a>

                                <button type="button" class="btn btn-info btn-sm btn-detail" data-bs-toggle="modal" data-bs-target="#detailModal" data-route="{{ route('user.show', $user->id) }}">
                                    <i class='bx bx-show'></i>
                                </button>

                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal" data-route="{{ route('user.destroy', $user->id) }}">
                                    <i class='bx bx-trash'></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @push('modals')
    <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="detailModalLabel">Detail {{ $title }}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modal-detail">
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fs-5" id="deleteModalLabel">Konfirmasi Hapus</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus user ini?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <form id="form-delete" action="" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endpush

    @push('scripts')
        <script>
            $('#data-table').on('click', '.btn-danger', function() {
                $('#form-delete').attr('action', $(this).data('route'));
            });

            $('#data-table').on('click', '.btn-detail', function() {
               
                $('#modal-detail').load($(this).data('route'));
            });
        </script>
    @endpush

</x-app>