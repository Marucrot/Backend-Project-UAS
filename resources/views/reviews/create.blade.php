<!DOCTYPE html>
<html>
<head>
    <title>Tambah Review</title>
</head>
<body>
    <h1>Tambah Review</h1>
    <a href="{{ route('reviews.index') }}">Kembali</a>

    <form action="{{ route('reviews.store') }}" method="POST">
        @csrf
        <table>
            <tr>
                <td>Tiket</td>
                <td>
                    <select name="ticket_id">
                        @foreach($tickets as $ticket)
                            <option value="{{ $ticket->id }}">{{ $ticket->nama_konser }}</option>
                        @endforeach
                    </select>
                </td>
            </tr>
            <tr>
                <td>Nama Reviewer</td>
                <td>{{ session('pengguna_nama') }}</td>
            </tr>
            <tr>
                <td>Rating (1-5)</td>
                <td><input type="number" name="rating" min="1" max="5"></td>
            </tr>
            <tr>
                <td>Komentar</td>
                <td><textarea name="komentar"></textarea></td>
            </tr>
        </table>
        <button type="submit">Simpan</button>
    </form>
</body>
</html>