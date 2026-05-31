<!DOCTYPE html>
<html>
<head>
    <title>Edit Review</title>
</head>
<body>
    <h1>Edit Review</h1>
    <a href="{{ route('reviews.index') }}">Kembali</a>

    <form action="{{ route('reviews.update', $review->id) }}" method="POST">
        @csrf
        @method('PUT')
        <table>
            <tr>
                <td>Tiket</td>
                <td>
                    <select name="ticket_id">
                        @foreach($tickets as $ticket)
                            <option value="{{ $ticket->id }}" {{ $review->ticket_id == $ticket->id ? 'selected' : '' }}>
                                {{ $ticket->nama_konser }}
                            </option>
                        @endforeach
                    </select>
                </td>
            </tr>
            <tr>
                <td>Nama Reviewer</td>
                <td><input type="text" name="nama_reviewer" value="{{ $review->nama_reviewer }}"></td>
            </tr>
            <tr>
                <td>Rating (1-5)</td>
                <td><input type="number" name="rating" min="1" max="5" value="{{ $review->rating }}"></td>
            </tr>
            <tr>
                <td>Komentar</td>
                <td><textarea name="komentar">{{ $review->komentar }}</textarea></td>
            </tr>
        </table>
        <button type="submit">Update</button>
    </form>
</body>
</html>