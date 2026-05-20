<?php
namespace App\Http\Controllers\AI;

use App\Http\Controllers\Controller;
use App\Services\AIHotelService;
use App\Models\Room;
use Illuminate\Http\Request;

class ResepsionisAIController extends Controller
{
    public function __construct(protected AIHotelService $ai) {}

    public function index()
    {
        $this->authorize('access-ai-resepsionis');
        return view('ai.resepsionis.index');
    }

    public function cariKamar(Request $request)
    {
        $this->authorize('access-ai-resepsionis');
        $request->validate([
            'jumlah_tamu' => 'required|integer|min:1',
            'check_in'    => 'required|date',
            'check_out'   => 'required|date|after:check_in',
            'kebutuhan'   => 'nullable|string',
        ]);

        $kamarTersedia = Room::where('status', 'available')
            ->where('capacity', '>=', $request->jumlah_tamu)
            ->whereDoesntHave('reservations', function ($q) use ($request) {
                $q->whereIn('status', ['confirmed', 'checked_in'])
                  ->where('check_in', '<', $request->check_out)
                  ->where('check_out', '>', $request->check_in);
            })
            ->get(['id', 'room_number', 'type', 'price_per_night', 'capacity', 'description'])
            ->toArray();

        $prompt = "Resepsionis butuh kamar untuk {$request->jumlah_tamu} tamu,
            check-in {$request->check_in}, check-out {$request->check_out}.
            Kebutuhan khusus: " . ($request->kebutuhan ?: 'tidak ada') . ".
            Kamar tersedia: " . json_encode($kamarTersedia) . ".
            Rekomendasikan kamar yang paling cocok beserta alasannya dalam Bahasa Indonesia.";

        $reply = $this->ai->chat($prompt,
            "Kamu adalah asisten resepsionis hotel yang membantu melayani tamu walk-in.");

        return response()->json(['saran' => $reply]);
    }

    public function tanganiKomplain(Request $request)
    {
        $this->authorize('access-ai-resepsionis');
        $request->validate(['komplain' => 'required|string|max:1000']);

        $prompt = "Tamu menyampaikan komplain: \"{$request->komplain}\".
            Berikan saran langkah penanganan yang profesional dan empati untuk resepsionis hotel.
            Format jawaban: langkah-langkah singkat yang bisa langsung dilakukan.
            Jawab dalam Bahasa Indonesia.";

        $reply = $this->ai->chat($prompt,
            "Kamu adalah supervisor hotel berpengalaman yang membantu resepsionis menangani komplain tamu.");

        return response()->json(['saran' => $reply]);
    }
}