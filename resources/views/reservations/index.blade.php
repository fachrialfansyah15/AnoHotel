@extends('layouts.admin')

@section('title', 'Reservations')

@section('content')

<div class="space-y-8">

    <!-- HEADER -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-5">

        <div>
            <p class="text-[#C9A84C] uppercase tracking-[0.25em] text-xs font-bold mb-3">
                Hotel Management
            </p>

            <h1 class="text-4xl md:text-5xl font-bold text-white">
                Reservations
            </h1>

            <p class="text-gray-400 mt-3 text-sm">
                Manage guest bookings and hotel reservations
            </p>
        </div>

        <a
            href="/reservations/create"
            class="bg-gradient-to-r from-[#C9A84C] to-yellow-500
                   hover:scale-105 transition-all duration-300
                   text-[#0D1117] font-semibold
                   px-7 py-4 rounded-2xl shadow-2xl"
        >
            + Create Reservation
        </a>

    </div>

    <!-- TABLE CARD -->
    <div class="bg-[#161B22] border border-white/10 rounded-[28px] overflow-hidden shadow-2xl">

        <!-- CARD HEADER -->
        <div class="flex items-center justify-between px-8 py-6 border-b border-white/5">

            <div>
                <h2 class="text-xl font-semibold text-white">
                    Reservation List
                </h2>

                <p class="text-gray-500 text-sm mt-1">
                    Latest reservation activity
                </p>
            </div>

            <div class="bg-[#212A38] px-4 py-2 rounded-xl text-sm text-gray-300">
                {{ count($reservations) }} Reservations
            </div>

        </div>

        <div class="overflow-x-auto">

            <table class="w-full">

                <thead class="bg-[#1C2330]">

                    <tr class="text-gray-400 text-xs uppercase tracking-[0.2em]">

                        <th class="text-left px-8 py-5">
                            Guest
                        </th>

                        <th class="text-left px-8 py-5">
                            Room
                        </th>

                        <th class="text-left px-8 py-5">
                            Check In
                        </th>

                        <th class="text-left px-8 py-5">
                            Status
                        </th>

                        <th class="text-left px-8 py-5">
                            Action
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($reservations as $reservation)

                    <tr class="border-b border-white/5 hover:bg-white/[0.02] transition">

                        <!-- GUEST -->
                        <td class="px-8 py-6">

                            <div class="flex items-center gap-4">

                                <div class="w-12 h-12 rounded-2xl
                                            bg-gradient-to-br from-[#C9A84C]/30 to-yellow-500/10
                                            flex items-center justify-center
                                            text-[#C9A84C] font-bold">

                                    {{ strtoupper(substr($reservation->user->name ?? 'G',0,1)) }}

                                </div>

                                <div>
                                    <h3 class="text-white font-semibold">
                                        {{ $reservation->user->name ?? 'Guest' }}
                                    </h3>

                                    <p class="text-gray-500 text-sm">
                                        Premium Guest
                                    </p>
                                </div>

                            </div>

                        </td>

                        <!-- ROOM -->
                        <td class="px-8 py-6 text-gray-300">

                            {{ $reservation->room->name ?? 'Room' }}

                        </td>

                        <!-- CHECK IN -->
                        <td class="px-8 py-6 text-gray-400">

                            {{ $reservation->check_in }}

                        </td>

                        <!-- STATUS -->
                        <td class="px-8 py-6">

                            @if($reservation->status == 'pending')

                                <span class="px-4 py-2 rounded-full text-xs font-semibold
                                            bg-yellow-500/10 text-yellow-400 border border-yellow-500/20">
                                    Pending
                                </span>

                            @elseif($reservation->status == 'confirmed')

                                <span class="px-4 py-2 rounded-full text-xs font-semibold
                                            bg-green-500/10 text-green-400 border border-green-500/20">
                                    Confirmed
                                </span>

                            @elseif($reservation->status == 'checked_in')

                                <span class="px-4 py-2 rounded-full text-xs font-semibold
                                            bg-blue-500/10 text-blue-400 border border-blue-500/20">
                                    Checked In
                                </span>

                            @elseif($reservation->status == 'checked_out')

                                <span class="px-4 py-2 rounded-full text-xs font-semibold
                                            bg-purple-500/10 text-purple-400 border border-purple-500/20">
                                    Checked Out
                                </span>

                            @else

                                <span class="px-4 py-2 rounded-full text-xs font-semibold
                                            bg-red-500/10 text-red-400 border border-red-500/20">
                                    Cancelled
                                </span>

                            @endif

                        </td>

                        <!-- ACTION -->
                        <td class="px-8 py-6">

                            <div class="flex gap-3">

                                <a
                                    href="/reservations/{{ $reservation->id }}"
                                    class="px-5 py-2 rounded-xl
                                           bg-[#212A38]
                                           hover:bg-[#2A3445]
                                           text-gray-300 text-sm transition"
                                >
                                    View
                                </a>

                                <a
                                    href="/reservations/{{ $reservation->id }}/edit"
                                    class="px-5 py-2 rounded-xl
                                           bg-gradient-to-r from-[#C9A84C] to-yellow-500
                                           hover:scale-105 transition
                                           text-[#0D1117] font-semibold text-sm"
                                >
                                    Edit
                                </a>

                            </div>

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="5" class="text-center py-20">

                            <div class="flex flex-col items-center">

                                <div class="w-20 h-20 rounded-full
                                            bg-[#212A38]
                                            flex items-center justify-center
                                            text-3xl mb-5">

                                    🏨

                                </div>

                                <h3 class="text-white text-xl font-semibold">
                                    No Reservations Found
                                </h3>

                                <p class="text-gray-500 mt-2">
                                    Reservation data will appear here
                                </p>

                            </div>

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection