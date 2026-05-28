<!DOCTYPE html>
<html>
<head>
    <title>detail Venue</title>
</head>
<body>
    <h1>detail Venue</h1>
    <a href="{{ route('venues.index') }}">back</a>

    <table border="1">
        <tr>
            <th>Nama Venue</th>
            <td>{{ $venue->nama_venue }}</td>
        </tr>
        <tr>
            <th>Alamat</th>
            <td>{{ $venue->alamat }}</td>
        </tr>
        <tr>
            <th>Kota</th>
            <td>{{ $venue->kota }}</td>
        </tr>
        <tr>
            <th>Kapasitas</th>
            <td>{{ $venue->kapasitas }}</td>
        </tr>
    </table>
</body>
</html>