<h1>Edit Detail Pembayaran</h1>

<form action="/payment-details/{{ $payment_detail->id }}" method="POST">
    @csrf
    @method('PUT')
    
    <label>Nama Bank</label><br>
    <input type="text" name="nama_bank" value="{{ $payment_detail->nama_bank }}">
    <br><br>
    <label>Nomor Rekening</label><br>
    <input type="text" name="nomor_rekening" value="{{ $payment_detail->nomor_rekening }}">
    <br><br>
    <label>Nama Pengirim</label><br>
    <input type="text" name="nama_pengirim" value="{{ $payment_detail->nama_pengirim }}">
    <br><br>
    <button type="submit">Update</button>
</form>