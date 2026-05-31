<!DOCTYPE html>
<html>
<head>
    <title>daftar Venue</title>
</head>
<body>
    <h1>daftar Venue</h1>
    <a href="{{ route('venues.index', ['sort' => 'asc']) }}">Kapasitas ↑</a>
    <a href="{{ route('venues.index', ['sort' => 'desc']) }}">Kapasitas ↓</a>
    <a href="{{ route('venues.create') }}">tambah Venue</a>

    @if(session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nama Venue</th>
            <th>Alamat</th>
            <th>Kota</th>
            <th>Kapasitas</th>
            <th>Aksi</th>
        </tr>
        @foreach($venues as $venue)
        <tr>
            <td>{{ $venue->id }}</td>
            <td>{{ $venue->nama_venue }}</td>
            <td>{{ $venue->alamat }}</td>
            <td>{{ $venue->kota }}</td>
            <td>{{ $venue->kapasitas }}</td>
            <td>
                <a href="{{ route('venues.show', $venue->id) }}">detail</a>
                <a href="{{ route('venues.edit', $venue->id) }}">edit</a>
                <form action="{{ route('venues.destroy', $venue->id) }}" method="POST" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit">delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
</body>
</html>