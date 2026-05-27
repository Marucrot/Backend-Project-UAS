<h1>Daftar Booking</h1>

@foreach($booking as $booking)
    <p>
        Nama Konser: {{ $booking->ticket->nama_konser }} <br>
        Tipe Tiket: {{ $booking->ticket->tipe_ticket }}<br>
        Ticket ID: {{ $booking->ticket_id }} <br>
        Jumlah Tiket: {{ $booking->kuantitas }} <br>
        Total:
        Rp{{ number_format($booking->total_harga, 0, ',', '.') }} <br>
        Status: {{ $booking->status }}
    </p>

    <hr>
@endforeach