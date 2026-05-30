<h1>Detail Bukti Pembayaran</h1>

<p>Payment ID: {{ $payment_detail->payment_id }}</p>
<p>Konser: {{ $payment_detail->payment->booking->ticket->nama_konser }}</p>
<p>Jumlah Bayar: Rp{{ number_format($payment_detail->payment->jumlah_bayar, 0, ',', '.') }}</p>
<p>Metode: {{ $payment_detail->payment->metode_pembayaran }}</p>
<p>Status: {{ $payment_detail->payment->status }}</p>
<hr>
<p>Nama Bank: {{ $payment_detail->nama_bank }}</p>
<p>Nomor Rekening: {{ $payment_detail->nomor_rekening }}</p>
<p>Nama Pengirim: {{ $payment_detail->nama_pengirim }}</p>

<a href="/payment-details">Kembali</a>