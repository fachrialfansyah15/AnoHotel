<?php
namespace App\Http\Controllers\AI;

use App\Http\Controllers\Controller;
use App\Services\AIHotelService;
use App\Models\Room;
use App\Models\Reservation;
use App\Models\Payment;
use Illuminate\Http\Request;

class ManajerAIController extends Controller
{
    public function __construct(protected AIHotelService $ai) {}

    public function index()
    {
        $this->authorize('access-ai-manajer');
        return view('ai.index_manajer');
    }

    public function insight(Request $request)
    {
        $this->authorize('access-ai-manajer');

        $totalKamar = Room::count();
        $occupied   = Room::where('status', 'occupied')->count();

        $data = [
            'okupansi' => [
                'total_kamar' => $totalKamar,
                'tersedia'    => Room::where('status', 'available')->count(),
                'occupied'    => $occupied,
                'maintenance' => Room::where('status', 'maintenance')->count(),
                'persen'      => $totalKamar > 0 ? round(($occupied / $totalKamar) * 100) : 0,
            ],
            'reservasi_hari_ini'   => Reservation::whereDate('check_in', today())->count(),
            'checkout_hari_ini'    => Reservation::whereDate('check_out', today())->count(),
            'reservasi_pending'    => Reservation::where('status', 'pending')->count(),
            'pendapatan_bulan_ini' => Payment::where('status', 'paid')
                ->whereMonth('created_at', now()->month)
                ->sum('amount'),
            'transaksi_per_metode' => Payment::where('status', 'paid')
                ->selectRaw('method, count(*) as total')
                ->groupBy('method')
                ->pluck('total', 'method'),
        ];

        $prompt = "Data operasional hotel saat ini: " . json_encode($data) . "
            Berikan: 1) Analisis singkat kondisi hotel, 2) Identifikasi masalah jika ada,
            3) Maksimal 3 saran tindakan prioritas. Jawab dalam Bahasa Indonesia.";

        $reply = $this->ai->chat($prompt,
            "Kamu adalah konsultan manajemen hotel yang memberikan insight berbasis data kepada manajer.");

        return response()->json([
            'insight' => $reply,
            'metrics' => [
                'total'      => $data['okupansi']['total_kamar'],
                'terisi'     => $data['okupansi']['occupied'],
                'tersedia'   => $data['okupansi']['tersedia'],
                'okupansi'   => $data['okupansi']['persen'],
                'checkin'    => $data['reservasi_hari_ini'],
                'checkout'   => $data['checkout_hari_ini'],
                'pending'    => $data['reservasi_pending'],
                'pendapatan' => $data['pendapatan_bulan_ini'],
            ]
        ]);
    }

    public function laporanRingkas(Request $request)
    {
        $this->authorize('access-ai-manajer');
        $request->validate(['periode' => 'required|in:hari_ini,minggu_ini,bulan_ini']);

        $query = Payment::where('status', 'paid');

        $query = match($request->periode) {
            'hari_ini'   => $query->whereDate('created_at', today()),
            'minggu_ini' => $query->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]),
            'bulan_ini'  => $query->whereMonth('created_at', now()->month),
        };

        $data = [
            'periode'          => $request->periode,
            'total_pendapatan' => $query->sum('amount'),
            'jumlah_transaksi' => $query->count(),
            'rata_rata'        => round($query->avg('amount') ?? 0),
            'per_metode'       => $query->selectRaw('method, sum(amount) as total')
                ->groupBy('method')
                ->pluck('total', 'method'),
        ];

        $prompt = "Data pembayaran hotel periode {$request->periode}: " . json_encode($data) . "
            Buat ringkasan laporan singkat dengan interpretasi performa keuangan hotel.
            Jawab dalam Bahasa Indonesia.";

        $reply = $this->ai->chat($prompt,
            "Kamu adalah analis bisnis hotel yang membantu manajer memahami performa keuangan.");

        return response()->json(['laporan' => $reply]);
    }
}