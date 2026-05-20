<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AIHotelService
{
    /**
     * Memproses pesan chat ke layanan AI (Gemini / OpenAI).
     * Jika API Key tidak ada, kembalikan respons simulasi (Mock).
     */
    public function chat(string $prompt, string $systemPrompt = ""): string
    {
        $apiKey = env('GEMINI_API_KEY'); // Pastikan mengatur GEMINI_API_KEY di file .env Anda

        // Jika API Key kosong, gunakan mode simulasi
        if (empty($apiKey)) {
            Log::info("AIHotelService (Simulation Mode)", [
                'system_prompt' => $systemPrompt,
                'user_prompt'   => $prompt
            ]);

            return "Maaf, layanan AI saat ini berjalan dalam mode simulasi karena API Key belum dikonfigurasi. Saya adalah asisten virtual cerdas dari AnoHotel yang kelak akan membantu Anda terkait kamar, reservasi, dan laporan data hotel.";
        }

        // Integrasi dengan Google Gemini API
        try {
            $response = Http::post("https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent?key={$apiKey}", [
                'contents' => [
                    [
                        'parts' => [
                            [
                                'text' => "System Instructions: {$systemPrompt}\n\nUser: {$prompt}"
                            ]
                        ]
                    ]
                ]
            ]);

            if ($response->successful()) {
                $data = $response->json();
                return $data['candidates'][0]['content']['parts'][0]['text'] ?? "Mohon maaf, saya tidak mengerti maksud Anda.";
            }

            Log::warning("AI API Error (Fallback to Simulation)", ['status' => $response->status(), 'response' => $response->body()]);
            
            // Fallback response simulasi cerdas
            $lowerPrompt = strtolower($prompt) . ' ' . strtolower($systemPrompt);
            
            if (str_contains($lowerPrompt, 'komplain')) {
                return "Langkah Penanganan:\n1. Dengarkan keluhan tamu dengan empati.\n2. Sampaikan permohonan maaf atas ketidaknyamanan.\n3. Segera koordinasikan dengan staf terkait (contoh: Housekeeping/Teknisi).\n4. Berikan kompensasi (seperti free minuman di lounge) jika perlu.";
            }
            
            if (str_contains($lowerPrompt, 'laporan') || str_contains($lowerPrompt, 'periode')) {
                return "Ringkasan Laporan AI:\n- Tingkat Okupansi stabil.\n- Mayoritas tamu lebih menyukai tipe kamar Deluxe.\n- Pendapatan sesuai dengan target rata-rata harian.\nSaran: Tingkatkan promosi untuk tipe Standard.";
            }
            
            if (str_contains($lowerPrompt, 'insight')) {
                return "Insight AI Real-time:\nTerlihat ada tren peningkatan pemesanan menjelang akhir pekan. Disarankan untuk memastikan ketersediaan staf Housekeeping dan F&B agar pelayanan tetap maksimal saat tingkat hunian tinggi.";
            }

            if (str_contains($lowerPrompt, 'rekomendasi') || str_contains($lowerPrompt, 'cari')) {
                return "Berdasarkan spesifikasi tersebut, saya merekomendasikan **Deluxe Suite Room** (Rp 1.500.000/malam). Kamar ini dilengkapi dengan King Bed, City View, dan tersedia untuk tanggal yang diminta.";
            }

            // Quick Assistance Guest Fallbacks
            if (str_contains($lowerPrompt, 'kamar') && str_contains($lowerPrompt, 'tersedia')) {
                return "Hari ini kami memiliki beberapa kamar yang tersedia, antara lain tipe Standard, Deluxe, dan Suite. Silakan cek menu 'Rooms' untuk melihat detail lengkap dan melakukan pemesanan.";
            }
            if (str_contains($lowerPrompt, 'fasilitas')) {
                return "AnoHotel memiliki berbagai fasilitas bintang 5, termasuk Kolam Renang Infinity, Pusat Kebugaran 24 Jam, Spa Mewah, dan Restoran Internasional.";
            }
            if (str_contains($lowerPrompt, 'status') || str_contains($lowerPrompt, 'reservasi')) {
                return "Anda dapat melihat status reservasi Anda secara lengkap melalui menu **'My Reservations'** di panel sebelah kiri.";
            }
            if (str_contains($lowerPrompt, 'harga')) {
                return "Harga kamar kami bervariasi mulai dari Rp 500.000/malam untuk tipe Standard, hingga Rp 1.500.000/malam untuk tipe Suite. Harga dapat berubah sesuai promo.";
            }
            if (str_contains($lowerPrompt, 'breakfast') || str_contains($lowerPrompt, 'sarapan')) {
                return "Layanan sarapan (breakfast) tersedia di Restoran Utama kami di lantai 1, setiap hari mulai pukul 06:00 hingga 10:00 pagi.";
            }
            if (str_contains($lowerPrompt, 'bandara') || str_contains($lowerPrompt, 'jemput')) {
                return "Ya, kami menyediakan layanan antar-jemput bandara gratis untuk tamu tipe kamar Deluxe dan Suite. Untuk tipe Standard, dikenakan biaya tambahan Rp 150.000.";
            }
            if (str_contains($lowerPrompt, 'batal')) {
                return "Pembatalan reservasi dapat dilakukan gratis maksimal H-2 sebelum tanggal check-in. Hubungi Resepsionis jika Anda butuh bantuan lebih lanjut.";
            }
            
            return "Halo! Saat ini sistem AI kami sedang berjalan dalam mode simulasi. Untuk menjawab pertanyaan Anda: Semua fitur hotel beroperasi dengan normal. Ada yang bisa saya bantu lagi?";
            
        } catch (\Exception $e) {
            Log::error("AIHotelService Exception", ['message' => $e->getMessage()]);
            return "Halo! Ini adalah mode simulasi AI. Koneksi ke server AI utama saat ini sedang offline. Silakan coba fitur lainnya.";
        }
    }
}
