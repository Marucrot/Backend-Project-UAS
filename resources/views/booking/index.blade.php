<h1>Daftar Booking</h1>

@foreach($booking as $booking)
    <p>
        Nama Konser: {{ $booking->ticket->nama_konser }} <br>
        Nama Artis: {{ $booking->ticket->nama_artis }} <br>
        Venue: {{ $booking->ticket->venue?->nama_venue }}<br>
        Tanggal Konser: {{ $booking->ticket->tanggal_konser }} <br>
        Jam Konser: {{ substr($booking->ticket->jam_konser, 0, 5) }} <br>git
        Tipe Tiket: {{ $booking->ticket->tipe_ticket }} <br>
        Ticket ID: {{ $booking->ticket_id }} <br>
        Jumlah Tiket: {{ $booking->kuantitas }} <br>
        Total:
        Rp{{ number_format($booking->total_harga, 0, ',', '.') }} <br>
        Status: {{ $booking->status }}
    </p>

    @if($booking->status == 'pending')
        <a href="/payments/create?booking_id={{ $booking->id }}">Bayar Sekarang</a>
    @else
        <span>Sudah Dibayar</span>
    @endif

    <hr>
@endforeach