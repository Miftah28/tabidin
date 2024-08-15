<?php

namespace App\Http\Controllers;

use App\Models\Baca;
use App\Models\Buku;
use App\Models\Kategori;
use App\Models\peminjaman;
use App\Models\Pengunjung;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{
    public function kategoribuku()
    {
        $kategori = Kategori::all();
        return response()->json([
            'success' => true,
            'data' => [
                'kategori' => $kategori,
                // 'lokasi' => $lokasi
            ],
            'message' => 'Sukses menampilkan data'
        ]);
    }
    public function buku($idkategori)
    {
        $buku = Buku::where('kategori_id', $idkategori)->get();
        return response()->json([
            'success' => true,
            'data' => [
                'buku' => $buku,
                // 'lokasi' => $lokasi
            ],
            'message' => 'Sukses menampilkan data'
        ]);
    }
    public function countperbulan()
    {

        $countsPerMonth = [];
        $currentDate = Carbon::now();

        // Loop untuk menghitung peminjaman selama 12 bulan terakhir
        for ($i = 0; $i < 12; $i++) {
            $startOfMonth = $currentDate->copy()->subMonths($i)->startOfMonth();
            $endOfMonth = $currentDate->copy()->subMonths($i)->endOfMonth();

            $countpinjam = Peminjaman::whereBetween('tanggal_pinjam', [$startOfMonth, $endOfMonth])->count();
            $countbaca = Baca::whereBetween('tanggal_baca', [$startOfMonth, $endOfMonth])->count();
            $countpengunjung = Pengunjung::whereBetween('created_at', [$startOfMonth, $endOfMonth])->count();

            $countsPerMonth[] = [
                'month' => $startOfMonth->format('Y-m'), // Format bulan dan tahun, misalnya '2024-06'
                'countpinjambulan' => $countpinjam,
                'countpengunjungbulan' => $countpengunjung,
                'countbacabulan' => $countbaca,
            ];
        }

        return response()->json([
            'success' => true,
            'data' => $countsPerMonth,
            'message' => 'Sukses menampilkan data per bulan selama 12 bulan terakhir'
        ]);
    }
    public function datacount()
    {
        $countpinjam = Peminjaman::count();
        $countbaca = Baca::count();
        $countpengunjung = Pengunjung::count();
        $countsPerMonth[] = [
            'countpinjam' => $countpinjam,
            'countpengunjung' => $countpengunjung,
            'countbaca' => $countbaca,
        ];
        return response()->json([
            'success' => true,
            'data' => $countsPerMonth,
            'message' => 'Sukses menampilkan data per bulan selama 12 bulan terakhir'
        ]);
    }
    public function datamarge()
    {
        // Mengambil jumlah peminjaman per buku
        $countsPinjam = Peminjaman::select('buku_id', DB::raw('count(*) as total_pinjam'))
            ->groupBy('buku_id')
            ->pluck('total_pinjam', 'buku_id');

        // Mengambil jumlah pembacaan per buku
        $countsBaca = Baca::select('buku_id', DB::raw('count(*) as total_baca'))
            ->groupBy('buku_id')
            ->pluck('total_baca', 'buku_id');

        // Menggabungkan kedua hitungan
        $mergedCounts = [];

        foreach ($countsPinjam as $bookId => $totalPinjam) {
            $totalBaca = $countsBaca->get($bookId, 0);
            $mergedCounts[] = [
                'buku_id' => $bookId,
                'total_pinjam' => $totalPinjam,
                'total_baca' => $totalBaca,
                'total_activity' => $totalPinjam + $totalBaca,
            ];
        }

        // Menghitung total pengunjung
        $countpengunjung = Pengunjung::count();

        return response()->json([
            'success' => true,
            'data' => $mergedCounts,
            'total_pengunjung' => $countpengunjung,
            'message' => 'Sukses menampilkan data per buku'
        ]);
    }
}
