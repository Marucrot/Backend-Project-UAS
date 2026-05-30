<h1>Detail Payment</h1>

<p>Payment ID: {{ $payment->id }}</p>
<p>Booking ID: {{ $payment->booking_id }}</p>
<p>Konser: {{ $payment->booking->ticket->nama_konser }}</p>
<p>Jumlah Tiket: {{ $payment->booking->kuantitas }}</p>
<p>Jumlah Bayar: Rp{{ number_format($payment->jumlah_bayar, 0, ',', '.') }}</p>
<p>Metode Pembayaran: {{ $payment->metode_pembayaran }}</p>
<p>Status: {{ $payment->status }}</p>

<a href="/payments">Kembali ke Daftar Payment</a>
