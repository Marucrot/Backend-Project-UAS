@extends('layouts.app')

@section('title', 'Edit Payment')

@section('content')
<section class="hero-panel">
    <h1>Edit Payment</h1>
    <p>Ubah metode atau status pembayaran.</p>
</section>

<form action="{{ route('payments.update', $payment->id) }}" method="POST" class="form-card">
    @csrf
    @method('PUT')

    <div class="field">
        <label>Metode Pembayaran</label>
        <select name="metode_pembayaran" required>
            <option value="transfer" {{ $payment->metode_pembayaran === 'transfer' ? 'selected' : '' }}>Transfer Bank</option>
            <option value="e_wallet" {{ $payment->metode_pembayaran === 'e_wallet' ? 'selected' : '' }}>E-Wallet</option>
            <option value="kartu_kredit" {{ $payment->metode_pembayaran === 'kartu_kredit' ? 'selected' : '' }}>Kartu Kredit</option>
        </select>
    </div>

    <div class="field">
        <label>Status</label>
        <select name="status" required>
            <option value="pending" {{ $payment->status === 'pending' ? 'selected' : '' }}>Pending</option>
            <option value="sukses" {{ $payment->status === 'sukses' ? 'selected' : '' }}>Sukses</option>
            <option value="gagal" {{ $payment->status === 'gagal' ? 'selected' : '' }}>Gagal</option>
        </select>
    </div>

    <div class="actions">
        <button type="submit" class="btn btn-primary">Update Payment</button>
        <a href="{{ route('payments.index') }}" class="btn btn-soft">Kembali</a>
    </div>
</form>
@endsection
