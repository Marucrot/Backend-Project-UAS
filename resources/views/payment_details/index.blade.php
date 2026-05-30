<h1>Daftar Payment Detail</h1>

@foreach($payment_details as $payment_detail)
    <p>
        Payment ID: {{ $payment_detail->payment_id }} <br>
        Nama Bank: {{ $payment_detail->nama_bank }} <br>
        Nomor Rekening: {{ $payment_detail->nomor_rekening }} <br>
        Nama Pengirim: {{ $payment_detail->nama_pengirim }}
    </p>

    <a href="/payment-details/{{ $payment_detail->id }}">Detail</a>
    <a href="/payment-details/{{ $payment_detail->id }}/edit">Edit</a>

    <form action="/payment-details/{{ $payment_detail->id }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit">Hapus</button>
    </form>
    <hr>
@endforeach