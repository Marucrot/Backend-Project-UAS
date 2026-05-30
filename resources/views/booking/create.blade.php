<h1>Booking Ticket</h1>

<form action="/booking" method="POST">
    @csrf

    <select name="ticket_id">
        @foreach($tickets as $ticket)
            <option value="{{ $ticket->id }}">
                {{ $ticket->nama_konser }} -
                {{ $ticket->nama_artis }} -
                {{ $ticket->venue?->nama_venue }} -
                {{ $ticket->tanggal_konser }} -
                {{ $ticket->jam_konser }} -
                {{ $ticket->tipe_ticket }} -
                Rp{{ number_format($ticket->harga, 0, ',', '.') }}
            </option>
        @endforeach
    </select>

    <input type="number" name="kuantitas" placeholder="Jumlah tiket">

    <button type="submit">Booking</button>
</form>