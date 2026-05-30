<h1>Daftar Payment</h1>

@foreach($payments as $payment)
    <p>
        Booking ID: {{ $payment->booking_id }} <br>
        Jumlah Bayar: Rp{{ number_format($payment->jumlah_bayar, 0, ',', '.') }} <br>
        Metode: {{ $payment->metode_pembayaran }} <br>
        Status: {{ $payment->status }}
    </p>

    <a href="/payments/{{ $payment->id }}">Detail</a>
    <a href="/payments/{{ $payment->id }}/edit">Edit</a>

    <form action="/payments/{{ $payment->id }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit">Hapus</button>
    </form>

    <hr>
@endforeach
