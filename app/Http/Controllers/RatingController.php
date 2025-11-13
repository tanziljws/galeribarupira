<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class RatingController extends Controller
{
    /**
     * Store a newly created rating in storage.
     * Rating disimpan ke tabel suggestions dengan tipe 'rating'
     */
    public function store(Request $request)
    {
        try {
            // Validate input
            $validated = $request->validate([
                'rating' => 'required|integer|min:1|max:5',
                'page' => 'required|string',
                'nama' => 'nullable|string|max:255'
            ]);

            // Simpan rating ke tabel ratings
            $nama = $validated['nama'];
            if (empty($nama) || $nama === 'Anonymous') {
                $nama = 'Anonymous';
            }
            
            $ratingData = [
                'rating' => $validated['rating'],
                'page' => $validated['page'],
                'nama' => $nama,
                'user_ip' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'created_at' => now(),
                'updated_at' => now()
            ];
            
            \Log::info('Rating saved', $ratingData);
            DB::table('ratings')->insert($ratingData);

            return response()->json([
                'success' => true,
                'message' => 'Rating berhasil disimpan'
            ]);
        } catch (\Exception $e) {
            \Log::error('Rating submission error', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'rating' => $validated['rating'] ?? null,
                'page' => $validated['page'] ?? null
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Gagal menyimpan rating: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Convert rating number to text
     */
    private function getRatingText($rating)
    {
        $ratings = [
            1 => 'Sangat Buruk',
            2 => 'Buruk',
            3 => 'Cukup',
            4 => 'Baik',
            5 => 'Sangat Baik'
        ];
        return $ratings[$rating] ?? 'Tidak Diketahui';
    }
}
