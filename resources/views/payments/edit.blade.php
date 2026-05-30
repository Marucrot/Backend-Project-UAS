<h1>Edit Payment</h1>

<form action="/payments/{{ $payment->id }}" method="POST">
    @csrf
    @method('PUT')

    <label>Metode Pembayaran</label><br>
    <select name="metode_pembayaran">
        <option value="transfer" {{ $payment->metode_pembayaran == 'transfer'     ? 'selected' : '' }}>Transfer Bank</option>
        <option value="kartu_kredit" {{ $payment->metode_pembayaran == 'kartu_kredit' ? 'selected' : '' }}>Kartu Kredit</option>
        <option value="e_wallet" {{ $payment->metode_pembayaran == 'e_wallet'     ? 'selected' : '' }}>E-Wallet</option>
    </select>
    <br><br>
    <label>Status</label><br>
    <select name="status">
        <option value="pending" {{ $payment->status == 'pending' ? 'selected' : '' }}>Pending</option>
        <option value="sukses" {{ $payment->status == 'sukses'  ? 'selected' : '' }}>Sukses</option>
        <option value="gagal" {{ $payment->status == 'gagal'   ? 'selected' : '' }}>Gagal</option>
    </select>
    <br><br>
    <button type="submit">Update</button>
</form>
