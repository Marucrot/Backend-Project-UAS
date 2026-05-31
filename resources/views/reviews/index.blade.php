<!DOCTYPE html>
<html>
<head>
    <title>Daftar Review</title>
</head>
<body>
    <h1>Daftar Review</h1>
    <a href="{{ route('reviews.create') }}">Tambah Review</a>

    @if(session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <table border="1">
        <tr>
            <th>ID</th>
            <th>Tiket</th>
            <th>Nama Reviewer</th>
            <th>Rating</th>
            <th>Komentar</th>
            <th>Tanggal</th>
            <th>Aksi</th>
        </tr>
        @foreach($reviews as $review)
        <tr>
            <td>{{ $review->id }}</td>
            <td>{{ $review->ticket->nama_konser }}</td>
            <td>{{ $review->nama_reviewer }}</td>
            <td>{{ $review->rating }}/5</td>
            <td>{{ $review->komentar }}</td>
            <td>{{ $review->created_at->format('d-m-Y') }}</td>
            <td>
                <a href="{{ route('reviews.show', $review->id) }}">detail</a>
                <a href="{{ route('reviews.edit', $review->id) }}">edit</a>
                <form action="{{ route('reviews.destroy', $review->id) }}" method="POST" style="display:inline">
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