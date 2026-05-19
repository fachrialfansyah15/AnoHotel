<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guests - AnoHotel</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 min-h-screen p-8">

<div class="max-w-7xl mx-auto">

    <div class="flex justify-between items-center mb-8">

        <div>
            <h1 class="text-4xl font-bold text-blue-700">
                Guests
            </h1>

            <p class="text-gray-500 mt-2">
                Guest management system
            </p>
        </div>

    </div>

    <div class="bg-white rounded-3xl shadow-xl overflow-hidden">

        <table class="w-full">

            <thead class="bg-blue-700 text-white">

                <tr>
                    <th class="text-left p-5">User ID</th>
                    <th class="text-left p-5">Phone</th>
                    <th class="text-left p-5">ID Card</th>
                    <th class="text-left p-5">Address</th>
                </tr>

            </thead>

            <tbody>

                @forelse($guests as $guest)

                <tr class="border-b hover:bg-gray-50">

                    <td class="p-5">
                        {{ $guest->user_id }}
                    </td>

                    <td class="p-5">
                        {{ $guest->phone }}
                    </td>

                    <td class="p-5">
                        {{ $guest->id_card_number }}
                    </td>

                    <td class="p-5">
                        {{ $guest->address }}
                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="4" class="text-center py-10 text-gray-500">
                        No guests found
                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

</body>
</html>