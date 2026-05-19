<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payments - AnoHotel</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 min-h-screen p-8">

<div class="max-w-7xl mx-auto">

    <div class="flex justify-between items-center mb-8">

        <div>
            <h1 class="text-4xl font-bold text-blue-700">
                Payments
            </h1>

            <p class="text-gray-500 mt-2">
                Manage hotel payments
            </p>
        </div>

    </div>

    <div class="bg-white rounded-3xl shadow-xl overflow-hidden">

        <table class="w-full">

            <thead class="bg-blue-700 text-white">

                <tr>
                    <th class="text-left p-5">Reservation</th>
                    <th class="text-left p-5">Amount</th>
                    <th class="text-left p-5">Method</th>
                    <th class="text-left p-5">Status</th>
                </tr>

            </thead>

            <tbody>

                @forelse($payments as $payment)

                <tr class="border-b hover:bg-gray-50">

                    <td class="p-5">
                        #{{ $payment->reservation_id }}
                    </td>

                    <td class="p-5">
                        Rp {{ number_format($payment->amount) }}
                    </td>

                    <td class="p-5 capitalize">
                        {{ $payment->method }}
                    </td>

                    <td class="p-5">

                        <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">
                            {{ $payment->status }}
                        </span>

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="4" class="text-center py-10 text-gray-500">
                        No payments found
                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

</body>
</html>