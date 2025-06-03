<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Barang;
use App\Models\Transaksi;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
{
    $now = Carbon::now();
    $lastMonth = $now->copy()->subMonth();

    // 📦 Total Barang dan Pertumbuhan
    $totalBarang = Barang::count();
    $barangBulanLalu = Barang::whereMonth('created_at', $lastMonth->month)->count();
    $barangGrowth = $barangBulanLalu > 0 ? round((($totalBarang - $barangBulanLalu) / $barangBulanLalu) * 100, 1) : 0;

    // 📊 Total Stok dan Pertumbuhan
    $totalStok = Barang::sum('stok');
    $stokBulanLalu = Barang::whereMonth('updated_at', $lastMonth->month)->sum('stok');
    $stokGrowth = $stokBulanLalu > 0 ? round((($totalStok - $stokBulanLalu) / $stokBulanLalu) * 100, 1) : 0;

    // ✅ Barang Masuk dan Pertumbuhan
    $masuk = Transaksi::where('jenis', 'masuk')->sum('jumlah');
    $masukBulanLalu = Transaksi::where('jenis', 'masuk')->whereMonth('created_at', $lastMonth->month)->sum('jumlah');
    $masukGrowth = $masukBulanLalu > 0 ? round((($masuk - $masukBulanLalu) / $masukBulanLalu) * 100, 1) : 0;

    // ❌ Barang Keluar dan Pertumbuhan
    $keluar = Transaksi::where('jenis', 'keluar')->sum('jumlah');
    $keluarBulanLalu = Transaksi::where('jenis', 'keluar')->whereMonth('created_at', $lastMonth->month)->sum('jumlah');
    $keluarGrowth = $keluarBulanLalu > 0 ? round((($keluar - $keluarBulanLalu) / $keluarBulanLalu) * 100, 1) : 0;

    // ⚠️ Stok Menipis
    $stokMinim = Barang::where('stok', '<', 5)->get();

    // 🕒 Aktivitas Terakhir
    $recentAktivitas = Transaksi::with(['barang', 'user'])
        ->latest()
        ->take(5)
        ->get();

    return view('dashboard', compact(
        'totalBarang', 'barangGrowth',
        'totalStok', 'stokGrowth',
        'masuk', 'masukGrowth',
        'keluar', 'keluarGrowth',
        'stokMinim', 'recentAktivitas'
    ));
}

public function chartData(Request $request)
{
    $range = $request->query('range', 'day');
    $now = now();

    $chartData = [
        'labels' => [],
        'masuk' => [],
        'keluar' => []
    ];

    if ($range === 'day') {
        // Hari Ini per jam (0-23)
        for ($i = 0; $i < 24; $i++) {
            $label = str_pad($i, 2, '0', STR_PAD_LEFT) . ':00';
            $chartData['labels'][] = $label;

            $chartData['masuk'][] = Transaksi::where('jenis', 'masuk')
                ->whereBetween('created_at', [$now->copy()->startOfDay()->addHours($i), $now->copy()->startOfDay()->addHours($i + 1)])
                ->sum('jumlah');

            $chartData['keluar'][] = Transaksi::where('jenis', 'keluar')
                ->whereBetween('created_at', [$now->copy()->startOfDay()->addHours($i), $now->copy()->startOfDay()->addHours($i + 1)])
                ->sum('jumlah');
        }
    } elseif ($range === 'month') {
        // Bulan Ini per hari
        $daysInMonth = $now->daysInMonth;
        for ($i = 1; $i <= $daysInMonth; $i++) {
            $label = $i;
            $chartData['labels'][] = $label;

            $chartData['masuk'][] = Transaksi::where('jenis', 'masuk')
                ->whereDay('created_at', $i)
                ->whereMonth('created_at', $now->month)
                ->whereYear('created_at', $now->year)
                ->sum('jumlah');

            $chartData['keluar'][] = Transaksi::where('jenis', 'keluar')
                ->whereDay('created_at', $i)
                ->whereMonth('created_at', $now->month)
                ->whereYear('created_at', $now->year)
                ->sum('jumlah');
        }
    } else {
        // Tahun Ini per bulan
        for ($i = 1; $i <= 12; $i++) {
            $label = date('F', mktime(0, 0, 0, $i, 10));
            $chartData['labels'][] = $label;

            $chartData['masuk'][] = Transaksi::where('jenis', 'masuk')
                ->whereMonth('created_at', $i)
                ->whereYear('created_at', $now->year)
                ->sum('jumlah');

            $chartData['keluar'][] = Transaksi::where('jenis', 'keluar')
                ->whereMonth('created_at', $i)
                ->whereYear('created_at', $now->year)
                ->sum('jumlah');
        }
    }

    return response()->json($chartData);
}


    public function stokPerKategori()
    {
        $data = DB::table('barang')
            ->join('kategori', 'barang.kategori_id', '=', 'kategori.id')
            ->select('kategori.nama as kategori', DB::raw('SUM(stok) as total_stok'))
            ->groupBy('kategori.nama')
            ->get();

        return response()->json([
            'labels' => $data->pluck('kategori'),
            'data' => $data->pluck('total_stok')
        ]);
    }
}
