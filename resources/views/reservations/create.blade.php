<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Reservation</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 min-h-screen p-8">

<div class="max-w-3xl mx-auto">

    <!-- HEADER -->
    <div class="mb-8">

        <h1 class="text-4xl font-bold text-blue-700">
            Create Reservation
        </h1>

        <p class="text-gray-500 mt-2">
            Book your hotel room
        </p>

    </div>

    <!-- CARD -->
    <div class="bg-white rounded-3xl shadow-xl p-8">

        <form
            action="/reservations"
            method="POST"
            class="space-y-6"
        >

            @csrf

            <!-- ROOM -->
            <div>

                <label class="block mb-2 font-semibold text-gray-700">
                    Room
                </label>

                <select
                    name="room_id"
                    class="w-full border border-gray-300 rounded-xl px-4 py-3"
                >

                    @foreach($rooms as $room)

                    <option value="{{ $room->id }}">

                        {{ $room->name }}

                    </option>

                    @endforeach

                </select>

            </div>

            <!-- CHECK IN -->
            <div>

                <label class="block mb-2 font-semibold text-gray-700">
                    Check In
                </label>

                <input
                    type="date"
                    name="check_in"
                    class="w-full border border-gray-300 rounded-xl px-4 py-3"
                >

            </div>

            <!-- CHECK OUT -->
            <div>

                <label class="block mb-2 font-semibold text-gray-700">
                    Check Out
                </label>

                <input
                    type="date"
                    name="check_out"
                    class="w-full border border-gray-300 rounded-xl px-4 py-3"
                >

            </div>

            <!-- TOTAL GUEST -->
            <div>

                <label class="block mb-2 font-semibold text-gray-700">
                    Total Guest
                </label>

                <input
                    type="number"
                    name="total_guest"
                    min="1"
                    class="w-full border border-gray-300 rounded-xl px-4 py-3"
                >

            </div>

            <!-- NOTES -->
            <div>

                <label class="block mb-2 font-semibold text-gray-700">
                    Notes
                </label>

                <textarea
                    name="notes"
                    rows="4"
                    class="w-full border border-gray-300 rounded-xl px-4 py-3"
                ></textarea>

            </div>

            <!-- BUTTON -->
            <button
                type="submit"
                class="w-full bg-blue-700 hover:bg-blue-800 text-white font-semibold py-4 rounded-xl transition"
            >
                Create Reservation
            </button>

        </form>

    </div>

</div>

</body>
</html>