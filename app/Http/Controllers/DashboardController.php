<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Barang;
use App\Models\Transaksi;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBarang = Barang::count();
        $totalStok   = Barang::sum('stok');
        $masuk       = Transaksi::where('jenis', 'masuk')->sum('jumlah');
        $keluar      = Transaksi::where('jenis', 'keluar')->sum('jumlah');

        // Barang dengan stok kurang dari 10
        $stokMinim = Barang::where('stok', '<', 10)->get();

        return view('dashboard', compact(
            'totalBarang', 'totalStok', 'masuk', 'keluar', 'stokMinim'
        ));
    }


    public function chartData()
    {
        $data = DB::table('transaksi')
            ->selectRaw("MONTH(created_at) as bulan, jenis, SUM(jumlah) as total")
            ->groupByRaw('bulan, jenis')
            ->get();

        $chartData = [
            'labels' => [],
            'masuk' => array_fill(1, 12, 0),
            'keluar' => array_fill(1, 12, 0)
        ];

        foreach ($data as $d) {
            $chartData['labels'][$d->bulan] = date('F', mktime(0, 0, 0, $d->bulan, 10));
            $chartData[$d->jenis][$d->bulan] = $d->total;
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

        $labels = $data->pluck('kategori');
        $values = $data->pluck('total_stok');

        return response()->json([
            'labels' => $labels,
            'data' => $values
        ]);
    }
}
