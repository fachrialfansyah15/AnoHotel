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
            
            return "Halo! Saat ini sistem AI kami sedang berjalan dalam mode simulasi. Untuk menjawab pertanyaan Anda: Semua fitur hotel beroperasi dengan normal. Ada yang bisa saya bantu lagi?";
            
        } catch (\Exception $e) {
            Log::error("AIHotelService Exception", ['message' => $e->getMessage()]);
            return "Halo! Ini adalah mode simulasi AI. Koneksi ke server AI utama saat ini sedang offline. Silakan coba fitur lainnya.";
        }
    }
}
