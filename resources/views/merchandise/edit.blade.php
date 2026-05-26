<h1>Edit Merchandise</h1>

<form action="{{ route('merchandises.update', $merchandise->id) }}" method="POST">
    @csrf
    @method('PUT')

    <label>Nama Merchandise</label><br>
    <input type="text" name="nama_merchandise" value="{{ $merchandise->nama_merchandise }}"><br><br>

    <label>Kategori</label><br>
    <input type="text" name="kategori" value="{{ $merchandise->kategori }}"><br><br>

    <label>Harga</label><br>
    <input type="number" name="harga" value="{{ $merchandise->harga }}"><br><br>

    <label>Stok</label><br>
    <input type="number" name="stok" value="{{ $merchandise->stok }}"><br><br>

    <label>Deskripsi</label><br>
    <textarea name="deskripsi">{{ $merchandise->deskripsi }}</textarea><br><br>

    <button type="submit">Update</button>
</form>