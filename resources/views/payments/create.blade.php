<h1>Form Pembayaran</h1>

<p>Booking ID: {{ $booking->id }}</p>
<p>Konser: {{ $booking->ticket->nama_konser }}</p>
<p>Jumlah Tiket: {{ $booking->kuantitas }}</p>
<p>Total Harga: Rp{{ number_format($booking->total_harga, 0, ',', '.') }}</p>

<form action="/payments" method="POST">
    @csrf
    <input type="hidden" name="booking_id" value="{{ $booking->id }}">
    <label>Metode Pembayaran</label><br>
    <select name="metode_pembayaran">
        <option value="transfer">Transfer Bank</option>
        <option value="kartu_kredit">Kartu Kredit</option>
        <option value="e_wallet">E-Wallet</option>
    </select>
    <br><br>
    <button type="submit">Bayar</button>
</form>
