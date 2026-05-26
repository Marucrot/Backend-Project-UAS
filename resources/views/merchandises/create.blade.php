<h1>Tambah Merchandise</h1>

<form action="{{ route('merchandises.store') }}" method="POST">
    @csrf

    <label>Nama Merchandise</label><br>
    <input type="text" name="nama_merchandise"><br><br>

    <label>Kategori</label><br>
    <input type="text" name="kategori"><br><br>

    <label>Harga</label><br>
    <input type="number" name="harga"><br><br>

    <label>Stok</label><br>
    <input type="number" name="stok"><br><br>

    <label>Deskripsi</label><br>
    <textarea name="deskripsi"></textarea><br><br>

    <button type="submit">Simpan</button>
</form>