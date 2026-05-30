<h1>Daftar Ticket</h1>

<a href="/tickets/create">Tambah Ticket</a>

@foreach($tickets as $ticket)

<p>
    {{ $ticket->nama_konser }} -
    {{ $ticket->nama_artis }} -
    {{ $ticket->venue?->nama_venue }} -
    {{ $ticket->tanggal_konser }} -
    {{ substr($ticket->jam_konser, 0, 5) }} -
    {{ $ticket->tipe_ticket }} -
    Rp{{ number_format($ticket->harga, 0, ',', '.') }}
    Stock: {{ $ticket->stock }}
</p>

<a href="/tickets/{{ $ticket->id }}/edit">Edit</a>

<form action="/tickets/{{ $ticket->id }}" method="POST">
    @csrf
    @method('DELETE')
    <button type="submit">Delete</button>
</form>

@endforeach