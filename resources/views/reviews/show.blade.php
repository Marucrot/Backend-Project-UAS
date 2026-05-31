<!DOCTYPE html>
<html>
<head>
    <title>Detail Review</title>
</head>
<body>
    <h1>Detail Review</h1>
    <a href="{{ route('reviews.index') }}">Kembali</a>

    <table border="1">
        <tr>
            <th>Tiket</th>
            <td>{{ $review->ticket->nama_konser }}</td>
        </tr>
        <tr>
            <th>Nama Reviewer</th>
            <td>{{ $review->nama_reviewer }}</td>
        </tr>
        <tr>
            <th>Rating</th>
            <td>{{ $review->rating }}/5</td>
        </tr>
        <tr>
            <th>Komentar</th>
            <td>{{ $review->komentar }}</td>
        </tr>
        <tr>
            <th>Tanggal</th>
            <td>{{ $review->created_at->format('d-m-Y') }}</td>
        </tr>
    </table>
</body>
</html>