<x-app>

    <x-slot:title>{{ $title }}</x-slot>

    <div class="card shadow p-3">
        <h5 class="fw-bold mb-0">{{ $title }}</h5>
      </div>


    <div class="card shadow p-3">

      <div class="">
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

      @foreach ($users as  $user)
            <tr>
            <th scope="row">{{ $loop->iteration }}</th>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->role }}</td>
            <td class="text-nowrap">
                <a href="{{ route('user.edit', $user->id) }}" class="btn btn-warning btn-sm"><i class='bx bx-edit-alt'></i></a>
                <form action="{{ route('user.destroy', $user->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this user?')"><i class='bx bx-trash' ></i></button>
                </form>
            </td>
                  
      </tr>
            
      @endforeach
    
   
  </tbody>
</table>
</div>
      </div>

      @push('modals')
   
@endpush

      @push('scripts')
   
@endpush

</x-app>