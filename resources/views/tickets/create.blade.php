<h1>Tambah Ticket</h1>

<form action="/tickets" method="POST">
    @csrf

    <input type="text" name="nama_konser" placeholder="Nama Konser">

    <input type="text" name="nama_artis" placeholder="Nama Artis">

    <select name="venue_id">
        @foreach($venues as $venue)
            <option value="{{ $venue->id }}">
                {{ $venue->nama_venue }}
            </option>
        @endforeach
    </select>

    <input type="date" name="tanggal_konser">

    <input type="time" name="jam_konser">

    <input type="number" name="harga" placeholder="Harga">

    <input type="number" name="stock" placeholder="Stock">

    <select name="tipe_ticket">
        <option value="VIP">VIP</option>
        <option value="Regular">Regular</option>
    </select>

    <button type="submit">Save</button>
</form>