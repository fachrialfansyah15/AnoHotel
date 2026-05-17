<h1>Data Kamar</h1>

<a href="{{ route('rooms.create') }}">
    Tambah Kamar
</a>

<table border="1" cellpadding="10">

    <tr>
        <th>Tipe</th>
        <th>Harga</th>
        <th>Status</th>
        <th>Aksi</th>
    </tr>

    @foreach($rooms as $room)

    <tr>
        <td>{{ $room->type }}</td>
        <td>{{ $room->price }}</td>
        <td>{{ $room->status }}</td>

        <td>

            <a href="{{ route('rooms.edit', $room->id) }}">
                Edit
            </a>

            <form action="{{ route('rooms.destroy', $room->id) }}"
                  method="POST">

                @csrf
                @method('DELETE')

                <button type="submit">
                    Hapus
                </button>

            </form>

        </td>
    </tr>

    @endforeach

</table>