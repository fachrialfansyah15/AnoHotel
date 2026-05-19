<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Edit Room - AnoHotel</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

</head>

<body class="min-h-screen bg-[#041026] text-white">

{{-- MAIN --}}
<main class="ml-[260px] min-h-screen p-8">

    <div class="max-w-3xl mx-auto">

        {{-- CARD --}}
        <div class="bg-[#0b1730]
                    border border-white/10
                    rounded-[28px]
                    p-8
                    shadow-2xl">

            {{-- HEADER --}}
            <div class="mb-8">

                <h1 class="text-4xl font-black text-yellow-400 mb-2">
                    Edit Kamar
                </h1>

                <p class="text-slate-400">
                    Perbarui informasi kamar hotel AnoHotel.
                </p>

            </div>

            {{-- ERROR --}}
            @if ($errors->any())

                <div class="mb-6
                            rounded-2xl
                            border border-red-500/20
                            bg-red-500/10
                            p-4">

                    <ul class="space-y-1 text-red-300 text-sm">

                        @foreach ($errors->all() as $error)

                            <li>
                                • {{ $error }}
                            </li>

                        @endforeach

                    </ul>

                </div>

            @endif

            {{-- FORM --}}
            <form action="{{ route('rooms.update', $room->id) }}"
                  method="POST"
                  class="space-y-6">

                @csrf
                @method('PUT')

                {{-- ROOM NUMBER --}}
                <div>

                    <label class="block
                                  mb-2
                                  text-sm
                                  font-semibold
                                  text-slate-300">

                        Nomor Kamar

                    </label>

                    <input type="text"
                           name="room_number"
                           value="{{ old('room_number', $room->room_number) }}"
                           placeholder="Contoh: 101"

                           class="w-full
                                  rounded-2xl
                                  bg-[#071225]
                                  border border-white/10
                                  px-5 py-4
                                  text-white
                                  outline-none
                                  focus:border-yellow-400">

                </div>

                {{-- TYPE --}}
                <div>

                    <label class="block
                                  mb-2
                                  text-sm
                                  font-semibold
                                  text-slate-300">

                        Tipe Kamar

                    </label>

                    <select name="type"

                            class="w-full
                                   rounded-2xl
                                   bg-[#071225]
                                   border border-white/10
                                   px-5 py-4
                                   text-white
                                   outline-none
                                   focus:border-yellow-400">

                        <option value="standard"
                            {{ $room->type == 'standard' ? 'selected' : '' }}>

                            Standard

                        </option>

                        <option value="deluxe"
                            {{ $room->type == 'deluxe' ? 'selected' : '' }}>

                            Deluxe

                        </option>

                        <option value="suite"
                            {{ $room->type == 'suite' ? 'selected' : '' }}>

                            Suite

                        </option>

                    </select>

                </div>

                {{-- PRICE --}}
                <div>

                    <label class="block
                                  mb-2
                                  text-sm
                                  font-semibold
                                  text-slate-300">

                        Harga per Malam

                    </label>

                    <input type="number"
                           name="price_per_night"
                           value="{{ old('price_per_night', $room->price_per_night) }}"
                           placeholder="Contoh: 350000"

                           class="w-full
                                  rounded-2xl
                                  bg-[#071225]
                                  border border-white/10
                                  px-5 py-4
                                  text-white
                                  outline-none
                                  focus:border-yellow-400">

                </div>

                {{-- CAPACITY --}}
                <div>

                    <label class="block
                                  mb-2
                                  text-sm
                                  font-semibold
                                  text-slate-300">

                        Kapasitas

                    </label>

                    <input type="number"
                           name="capacity"
                           value="{{ old('capacity', $room->capacity) }}"
                           placeholder="Contoh: 2"

                           class="w-full
                                  rounded-2xl
                                  bg-[#071225]
                                  border border-white/10
                                  px-5 py-4
                                  text-white
                                  outline-none
                                  focus:border-yellow-400">

                </div>

                {{-- STATUS --}}
                <div>

                    <label class="block
                                  mb-2
                                  text-sm
                                  font-semibold
                                  text-slate-300">

                        Status

                    </label>

                    <select name="status"

                            class="w-full
                                   rounded-2xl
                                   bg-[#071225]
                                   border border-white/10
                                   px-5 py-4
                                   text-white
                                   outline-none
                                   focus:border-yellow-400">

                        <option value="available"
                            {{ $room->status == 'available' ? 'selected' : '' }}>

                            Available

                        </option>

                        <option value="occupied"
                            {{ $room->status == 'occupied' ? 'selected' : '' }}>

                            Occupied

                        </option>

                        <option value="maintenance"
                            {{ $room->status == 'maintenance' ? 'selected' : '' }}>

                            Maintenance

                        </option>

                    </select>

                </div>

                {{-- DESCRIPTION --}}
                <div>

                    <label class="block
                                  mb-2
                                  text-sm
                                  font-semibold
                                  text-slate-300">

                        Deskripsi

                    </label>

                    <textarea name="description"
                              rows="4"

                              class="w-full
                                     rounded-2xl
                                     bg-[#071225]
                                     border border-white/10
                                     px-5 py-4
                                     text-white
                                     outline-none
                                     resize-none
                                     focus:border-yellow-400">{{ old('description', $room->description) }}</textarea>

                </div>

                {{-- BUTTON --}}
                <div class="flex items-center gap-4 pt-4">

                    <button type="submit"

                            class="bg-yellow-400
                                   hover:bg-yellow-300
                                   text-[#041026]
                                   font-bold
                                   px-7 py-4
                                   rounded-2xl
                                   transition">

                        Update Kamar

                    </button>

                    <a href="{{ route('rooms.index') }}"

                       class="border border-white/10
                              hover:bg-white/10
                              text-slate-300
                              px-7 py-4
                              rounded-2xl
                              transition">

                        Batal

                    </a>

                </div>

            </form>

        </div>

    </div>

</main>

</body>
</html>