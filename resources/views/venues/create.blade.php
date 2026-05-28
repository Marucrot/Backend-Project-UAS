<!DOCTYPE html>
<html>
<head>
    <title>tambah Venue</title>
</head>
<body>
    <h1>tambah Venue</h1>
    <a href="{{ route('venues.index') }}">back</a>

    <form action="{{ route('venues.store') }}" method="POST">
        @csrf
        <table>
            <tr>
                <td>Nama Venue</td>
                <td><input type="text" name="nama_venue"></td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td><textarea name="alamat"></textarea></td>
            </tr>
            <tr>
                <td>Kota</td>
                <td><input type="text" name="kota"></td>
            </tr>
            <tr>
                <td>Kapasitas</td>
                <td><input type="number" name="kapasitas"></td>
            </tr>
        </table>
        <button type="submit">save</button>
    </form>
</body>
</html>