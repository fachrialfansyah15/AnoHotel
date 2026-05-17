<h1>Tambah Kamar</h1>

<form action="{{ route('rooms.store') }}"
      method="POST">

    @csrf

    <input type="text"
           name="type"
           placeholder="Tipe kamar">

    <input type="number"
           name="price"
           placeholder="Harga">

    <select name="status">

        <option value="available">
            Available
        </option>

        <option value="booked">
            Booked
        </option>

    </select>

    <button type="submit">
        Simpan
    </button>

</form>