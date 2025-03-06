<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data User</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Data User</h1>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <a href="{{ route('user.tambah') }}" class="btn btn-primary mb-3">Tambah User</a>

        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Nama</th>
                    <th>ID Level Pengguna</th>
                    <th>Kode level</th>
                    <th>Nama Level</td>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @if ($data->isEmpty())
                    <tr>
                        <td colspan="5" class="text-center">Tidak ada data user.</td>
                    </tr>
                @else
                    @foreach ($data as $user)
                    <tr>
                        <td>{{ $user->user_id }}</td>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->nama }}</td>
                        <td>{{ $user->level_id }}</td>
                        <td>{{ optional($user->level)->level_kode }}</td>
                        <td>{{ optional($user->level)->level_nama }}</td>
                        <td>
                            <a href="{{ route('user.ubah', $user->user_id) }}" class="btn btn-warning btn-sm">Ubah</a>
                            <form action="{{ route('user.hapus', $user->user_id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus user ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
</body>
</html>

