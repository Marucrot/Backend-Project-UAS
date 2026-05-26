<h1>Detail Merchandise</h1>

<p>Nama: {{ $merchandise->nama_merchandise }}</p>
<p>Kategori: {{ $merchandise->kategori }}</p>
<p>Harga: {{ $merchandise->harga }}</p>
<p>Stok: {{ $merchandise->stok }}</p>
<p>Deskripsi: {{ $merchandise->deskripsi }}</p>

<a href="{{ route('merchandises.index') }}">Kembali</a>