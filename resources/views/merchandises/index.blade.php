<h1>Data Merchandise</h1>

<a href="{{ route('merchandises.create') }}">Tambah Merchandise</a>

<table border="1" cellpadding="10">
    <tr>
        <th>Nama</th>
        <th>Kategori</th>
        <th>Harga</th>
        <th>Stok</th>
        <th>Aksi</th>
    </tr>

    @foreach ($merchandises as $merchandise)
    <tr>
        <td>{{ $merchandise->nama_merchandise }}</td>
        <td>{{ $merchandise->kategori }}</td>
        <td>{{ $merchandise->harga }}</td>
        <td>{{ $merchandise->stok }}</td>
        <td>
            <a href="{{ route('merchandises.show', $merchandise->id) }}">Detail</a>
            <a href="{{ route('merchandises.edit', $merchandise->id) }}">Edit</a>

            <form action="{{ route('merchandises.destroy', $merchandise->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit">Hapus</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>