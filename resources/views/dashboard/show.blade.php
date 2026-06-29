<x-app>

   <div class="row g-3">
    <div class="col-md-3">
         <img src="{{ $user->avatar ? asset('storage/'. $user->avatar) : asset('niceadmin/img/noprofil.png') }}" alt="Avatar" class="img-thumbnail w-100 rounded"  >
    </div>
    
    <div class="col-md-9">
        <table class="table table-bordered">
            <tr>
                <th>Nama</th>
                <td>{{ $user->name }}</td>
            </tr>
            <tr>
                <th>Email</th>
                <td>{{ $user->email }}</td>
            </tr>
            <tr>
                <th>Role</th>
                <td>{{ $user->role }}</td>
            </tr>
            <tr>
                <th>Dibuat</th>
                <td>{{ $user->created_at->format('d M Y H:i') }}</td>
            </tr>
            <tr>
                <th>Diperbarui</th>
                <td>{{ $user->updated_at->format('d M Y H:i') }}</td>
            </tr>
        </table>

        <div class="mt-3">
             <a class="btn btn-warning" href="{{ route('dashboard.edit') }}">Edit Profile</a>
        </div>

       
    </div>
</div>



</x-app>