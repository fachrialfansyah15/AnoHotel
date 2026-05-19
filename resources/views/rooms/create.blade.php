<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Room - AnoHotel</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-[#041026] text-white">

@if(auth()->user()->role === 'guest')
    @include('layouts.sidebar-guest')
@else
    @include('layouts.sidebar-management')
@endif

<main class="ml-[260px] min-h-screen p-8">

    <div class="max-w-3xl mx-auto bg-[#0b1730] border border-white/10 rounded-3xl p-8 shadow-2xl">

        <h1 class="text-3xl font-bold text-yellow-400 mb-2">
            Tambah Kamar
        </h1>

        <p class="text-slate-400 mb-8">
            Tambahkan data kamar baru ke database AnoHotel.
        </p>

        @if ($errors->any())
            <div class="mb-6 rounded-xl border border-red-500/30 bg-red-500/10 p-4 text-red-300">
                <ul class="list-disc list-inside space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('rooms.store') }}" method="POST" class="space-y-5">
            @csrf

            <div>
                <label class="block mb-2 text-sm font-semibold text-slate-300">
                    Nomor Kamar
                </label>

                <input type="text"
                       name="room_number"
                       value="{{ old('room_number') }}"
                       placeholder="Contoh: 101"
                       class="w-full rounded-xl bg-[#071225] border border-white/10 px-4 py-3 text-white outline-none focus:border-yellow-400">
            </div>

            <div>
                <label class="block mb-2 text-sm font-semibold text-slate-300">
                    Tipe Kamar
                </label>

                <select name="type"
                        class="w-full rounded-xl bg-[#071225] border border-white/10 px-4 py-3 text-white outline-none focus:border-yellow-400">
                    <option value="">Pilih tipe kamar</option>
                    <option value="standard" {{ old('type') === 'standard' ? 'selected' : '' }}>Standard</option>
                    <option value="deluxe" {{ old('type') === 'deluxe' ? 'selected' : '' }}>Deluxe</option>
                    <option value="suite" {{ old('type') === 'suite' ? 'selected' : '' }}>Suite</option>
                </select>
            </div>

            <div>
                <label class="block mb-2 text-sm font-semibold text-slate-300">
                    Harga per Malam
                </label>

                <input type="number"
                       name="price_per_night"
                       value="{{ old('price_per_night') }}"
                       placeholder="Contoh: 350000"
                       min="0"
                       step="1000"
                       class="w-full rounded-xl bg-[#071225] border border-white/10 px-4 py-3 text-white outline-none focus:border-yellow-400">
            </div>

            <div>
                <label class="block mb-2 text-sm font-semibold text-slate-300">
                    Kapasitas
                </label>

                <input type="number"
                       name="capacity"
                       value="{{ old('capacity') }}"
                       placeholder="Contoh: 2"
                       min="1"
                       class="w-full rounded-xl bg-[#071225] border border-white/10 px-4 py-3 text-white outline-none focus:border-yellow-400">
            </div>

            <div>
                <label class="block mb-2 text-sm font-semibold text-slate-300">
                    Status
                </label>

                <select name="status"
                        class="w-full rounded-xl bg-[#071225] border border-white/10 px-4 py-3 text-white outline-none focus:border-yellow-400">
                    <option value="available" {{ old('status') === 'available' ? 'selected' : '' }}>Available</option>
                    <option value="occupied" {{ old('status') === 'occupied' ? 'selected' : '' }}>Occupied</option>
                    <option value="maintenance" {{ old('status') === 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                </select>
            </div>

            <div>
                <label class="block mb-2 text-sm font-semibold text-slate-300">
                    Deskripsi
                </label>

                <textarea name="description"
                          rows="4"
                          placeholder="Opsional, contoh: Kamar nyaman dengan pemandangan kota"
                          class="w-full rounded-xl bg-[#071225] border border-white/10 px-4 py-3 text-white outline-none focus:border-yellow-400">{{ old('description') }}</textarea>
            </div>

            <div class="flex items-center gap-4 pt-4">

                <button type="submit"
                        class="bg-yellow-400 hover:bg-yellow-300 text-[#041026] font-bold px-6 py-3 rounded-xl transition">
                    Simpan
                </button>

                <a href="{{ route('rooms.index') }}"
                   class="border border-white/10 hover:bg-white/10 text-slate-300 px-6 py-3 rounded-xl transition">
                    Batal
                </a>

            </div>

        </form>

    </div>

</main>

</body>
</html>