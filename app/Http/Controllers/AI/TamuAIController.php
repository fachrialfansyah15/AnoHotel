<?php
namespace App\Http\Controllers\AI;

use App\Http\Controllers\Controller;
use App\Services\AIHotelService;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TamuAIController extends Controller
{
    public function __construct(protected AIHotelService $ai) {}

    public function index()
    {
        $this->authorize('access-ai-tamu');
        return view('ai.tamu.index');
    }

    public function chat(Request $request)
    {
        $this->authorize('access-ai-tamu');
        $request->validate(['message' => 'required|string|max:500']);

        $user = Auth::user();

        $context = [
            'nama_tamu'       => $user->name,
            'reservasi_aktif' => $user->reservations()
                ->whereIn('status', ['pending', 'confirmed'])
                ->with('room:id,room_number,type,price_per_night')
                ->get(['id', 'room_id', 'check_in', 'check_out', 'status', 'total_guest'])
                ->toArray(),
            'kamar_tersedia'  => Room::where('status', 'available')
                ->get(['room_number', 'type', 'price_per_night', 'capacity'])
                ->toArray(),
        ];

        $systemPrompt = "Kamu adalah asisten hotel yang ramah untuk membantu tamu.
            Bantu tamu untuk informasi fasilitas, ketersediaan kamar, dan status reservasi.
            Data tamu & kamar saat ini: " . json_encode($context);

        $reply = $this->ai->chat($request->message, $systemPrompt);

        return response()->json(['reply' => $reply]);
    }

    public function rekomendasi(Request $request)
    {
        $this->authorize('access-ai-tamu');
        $request->validate([
            'jumlah_tamu' => 'required|integer|min:1',
            'preferensi'  => 'nullable|array',
            'budget'      => 'nullable|numeric',
        ]);

        $kamarTersedia = Room::where('status', 'available')
            ->get(['room_number', 'type', 'price_per_night', 'capacity', 'description'])
            ->toArray();

        $prompt = "Rekomendasikan kamar untuk {$request->jumlah_tamu} tamu" .
            ($request->budget ? " dengan budget Rp {$request->budget} per malam" : "") .
            ($request->preferensi ? ", preferensi: " . implode(', ', $request->preferensi) : "") .
            ". Kamar tersedia: " . json_encode($kamarTersedia) .
            ". Berikan rekomendasi terbaik beserta alasannya dalam Bahasa Indonesia.";

        $reply = $this->ai->chat($prompt,
            "Kamu adalah konsultan kamar hotel yang membantu tamu memilih kamar terbaik.");

        return response()->json(['rekomendasi' => $reply]);
    }
}