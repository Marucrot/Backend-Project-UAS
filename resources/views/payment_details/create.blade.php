<h1>Isi Detail Pembayaran</h1>

<p>Payment ID: {{ $payment->id }}</p>
<p>Konser: {{ $payment->booking->ticket->nama_konser }}</p>
<p>Jumlah Bayar: Rp{{ number_format($payment->jumlah_bayar, 0, ',', '.') }}</p>
<p>Metode: {{ $payment->metode_pembayaran }}</p>

<form action="/payment-details" method="POST">
    @csrf
    
    <input type="hidden" name="payment_id" value="{{ $payment->id }}">
    <label>Nama Bank</label><br>
    <input type="text" name="nama_bank" placeholder="Contoh: BCA, Mandiri, BNI">
    <br><br>
    <label>Nomor Rekening</label><br>
    <input type="text" name="nomor_rekening" placeholder="Contoh: 1234567890">
    <br><br>
    <label>Nama Pengirim</label><br>
    <input type="text" name="nama_pengirim" placeholder="Nama pemilik rekening">
    <br><br>
    <button type="submit">Simpan</button>
</form>