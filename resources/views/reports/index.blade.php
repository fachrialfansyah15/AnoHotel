<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports - AnoHotel</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 min-h-screen p-8">

<div class="max-w-7xl mx-auto">

    <!-- HEADER -->
    <div class="mb-10">

        <h1 class="text-4xl font-bold text-blue-700">
            Reports Dashboard
        </h1>

        <p class="text-gray-500 mt-2">
            Hotel analytics & business reports
        </p>

    </div>

    <!-- STATS -->
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">

        <!-- Revenue -->
        <div class="bg-white rounded-3xl shadow-xl p-8">

            <p class="text-gray-500 text-sm">
                Total Revenue
            </p>

            <h2 class="text-4xl font-bold text-green-600 mt-4">
                Rp {{ number_format($totalRevenue) }}
            </h2>

        </div>

        <!-- Reservations -->
        <div class="bg-white rounded-3xl shadow-xl p-8">

            <p class="text-gray-500 text-sm">
                Reservations
            </p>

            <h2 class="text-4xl font-bold text-blue-600 mt-4">
                {{ $totalReservations }}
            </h2>

        </div>

        <!-- Guests -->
        <div class="bg-white rounded-3xl shadow-xl p-8">

            <p class="text-gray-500 text-sm">
                Guests
            </p>

            <h2 class="text-4xl font-bold text-purple-600 mt-4">
                {{ $totalGuests }}
            </h2>

        </div>

        <!-- Available Rooms -->
        <div class="bg-white rounded-3xl shadow-xl p-8">

            <p class="text-gray-500 text-sm">
                Available Rooms
            </p>

            <h2 class="text-4xl font-bold text-orange-500 mt-4">
                {{ $availableRooms }}
            </h2>

        </div>

    </div>

    <!-- EXTRA SECTION -->
    <div class="bg-white rounded-3xl shadow-xl p-8 mt-8">

        <h2 class="text-2xl font-bold text-gray-800 mb-4">
            Report Summary
        </h2>

        <p class="text-gray-500 leading-relaxed">
            This dashboard displays hotel business statistics including
            total revenue, reservations, guests, and room availability.
            Reports are updated automatically based on system data.
        </p>

    </div>

</div>

</body>
</html>