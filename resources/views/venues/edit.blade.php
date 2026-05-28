<!DOCTYPE html>
<html>
<head>
    <title>edit Venue</title>
</head>
<body>
    <h1>edit Venue</h1>
    <a href="{{ route('venues.index') }}">back</a>

    <form action="{{ route('venues.update', $venue->id) }}" method="POST">
        @csrf
        @method('PUT')
        <table>
            <tr>
                <td>Nama Venue</td>
                <td><input type="text" name="nama_venue" value="{{ $venue->nama_venue }}"></td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td><textarea name="alamat">{{ $venue->alamat }}</textarea></td>
            </tr>
            <tr>
                <td>Kota</td>
                <td><input type="text" name="kota" value="{{ $venue->kota }}"></td>
            </tr>
            <tr>
                <td>Kapasitas</td>
                <td><input type="number" name="kapasitas" value="{{ $venue->kapasitas }}"></td>
            </tr>
        </table>
        <button type="submit">update</button>
    </form>
</body>
</html>