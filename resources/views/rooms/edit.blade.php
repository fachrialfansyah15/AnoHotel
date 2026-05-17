<h1>Edit Kamar</h1>

<form action="{{ route('rooms.update', $room->id) }}"
      method="POST">

    @csrf
    @method('PUT')

    <input type="text"
           name="type"
           value="{{ $room->type }}">

    <input type="number"
           name="price"
           value="{{ $room->price }}">

    <select name="status">

        <option value="available"
            {{ $room->status == 'available' ? 'selected' : '' }}>

            Available

        </option>

        <option value="booked"
            {{ $room->status == 'booked' ? 'selected' : '' }}>

            Booked

        </option>

    </select>

    <button type="submit">
        Update
    </button>

</form>