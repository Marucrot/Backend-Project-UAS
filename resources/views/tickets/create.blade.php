<h1>Tambah Ticket</h1>

<form action="/tickets" method="POST">
    @csrf

    <input type="text" name="kategori" placeholder="Nama Konser">
    <input type="number" name="harga" placeholder="Harga">
    <input type="number" name="stock" placeholder="Stock">

    <button type="submit">Save</button>
</form>