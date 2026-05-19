    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Reservation - AnoHotel</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 min-h-screen p-8">

<div class="max-w-4xl mx-auto">

    <!-- HEADER -->
    <div class="flex justify-between items-center mb-8">

        <div>
            <h1 class="text-4xl font-bold text-blue-700">
                Edit Reservation
            </h1>

            <p class="text-gray-500 mt-2">
                Update reservation information
            </p>
        </div>

        <a href="/reservations"
           class="bg-gray-200 hover:bg-gray-300 px-5 py-3 rounded-xl transition">
            Back
        </a>

    </div>

    <!-- CARD -->
    <div class="bg-white rounded-3xl shadow-xl p-8">

        <form
            action="/reservations/{{ $reservation->id }}"
            method="POST"
            class="space-y-6"
        >

            @csrf
            @method('PUT')

            <!-- ROOM -->
            <div>

                <label class="block text-gray-700 font-semibold mb-2">
                    Room
                </label>

                <select
                    name="room_id"
                    class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500"
                >

                    @foreach($rooms as $room)

                    <option
                        value="{{ $room->id }}"
                        {{ $reservation->room_id == $room->id ? 'selected' : '' }}
                    >
                        {{ $room->name }}
                    </option>

                    @endforeach

                </select>

            </div>

            <!-- CHECK IN -->
            <div>

                <label class="block text-gray-700 font-semibold mb-2">
                    Check In
                </label>

                <input
                    type="date"
                    name="check_in"
                    value="{{ $reservation->check_in }}"
                    class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500"
                >

            </div>

            <!-- CHECK OUT -->
            <div>

                <label class="block text-gray-700 font-semibold mb-2">
                    Check Out
                </label>

                <input
                    type="date"
                    name="check_out"
                    value="{{ $reservation->check_out }}"
                    class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500"
                >

            </div>

            <!-- TOTAL GUEST -->
            <div>

                <label class="block text-gray-700 font-semibold mb-2">
                    Total Guest
                </label>

                <input
                    type="number"
                    name="total_guest"
                    value="{{ $reservation->total_guest }}"
                    class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500"
                >

            </div>

            <!-- STATUS -->
            <div>

                <label class="block text-gray-700 font-semibold mb-2">
                    Status
                </label>

                <select
                    name="status"
                    class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500"
                >

                    <option value="pending"
                        {{ $reservation->status == 'pending' ? 'selected' : '' }}>
                        Pending
                    </option>

                    <option value="confirmed"
                        {{ $reservation->status == 'confirmed' ? 'selected' : '' }}>
                        Confirmed
                    </option>

                    <option value="checked_in"
                        {{ $reservation->status == 'checked_in' ? 'selected' : '' }}>
                        Checked In
                    </option>

                    <option value="checked_out"
                        {{ $reservation->status == 'checked_out' ? 'selected' : '' }}>
                        Checked Out
                    </option>

                    <option value="cancelled"
                        {{ $reservation->status == 'cancelled' ? 'selected' : '' }}>
                        Cancelled
                    </option>

                </select>

            </div>

            <!-- NOTES -->
            <div>

                <label class="block text-gray-700 font-semibold mb-2">
                    Notes
                </label>

                <textarea
                    name="notes"
                    rows="4"
                    class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500"
                >{{ $reservation->notes }}</textarea>

            </div>

            <!-- BUTTON -->
            <div class="pt-4">

                <button
                    type="submit"
                    class="w-full bg-blue-700 hover:bg-blue-800 text-white font-semibold py-4 rounded-xl transition"
                >
                    Update Reservation
                </button>

            </div>

        </form>

    </div>

</div>

</body>
</html>