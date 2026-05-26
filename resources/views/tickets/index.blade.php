<h1>Daftar Ticket</h1>

<a href="/tickets/create">Tambah Ticket</a>

@foreach($tickets as $ticket)
    <p>
        {{ $ticket->nama_konser }} -
        Rp{{ number_format($ticket->harga, 0, ',', '.') }}
        Stock: {{ $ticket->stock }}
    </p>

    <form action="/tickets/{{ $ticket->id }}" method="POST">
        @csrf
        @method('DELETE')

        <button type="submit">Delete</button>
    </form>
@endforeach