<h1>Tambah Ticket</h1>

<form action="/tickets" method="POST">
    @csrf

    <input type="text" name="nama_konser" placeholder="Nama Konser">
    <input type="number" name="harga" placeholder="Harga">
    <input type="number" name="stock" placeholder="Stock">
    <select name="tipe_ticket">
        <option value="VIP">VIP</option>
        <option value="Regular">Regular</option>
    </select>
    <button type="submit">Save</button>
</form>