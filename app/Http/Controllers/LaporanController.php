<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Transaksi;
use App\Exports\StokExport;
use App\Exports\TransaksiExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;


class LaporanController extends Controller
{
public function stok(Request $request) {
    $query = Barang::with('kategori');

    if ($request->kategori) {
        $query->where('kategori_id', $request->kategori);
    }

    if ($request->search) {
        $query->where('nama', 'like', '%' . $request->search . '%');
    }

    $barang = $query->get();
    $kategori = \App\Models\Kategori::all();

    return view('laporan.stok', compact('barang', 'kategori'));
}

public function transaksi(Request $request)
{
    $transaksi = \App\Models\Transaksi::with(['barang', 'supplier'])
        ->when($request->start_date, fn($q) => $q->whereDate('created_at', '>=', $request->start_date))
        ->when($request->end_date, fn($q) => $q->whereDate('created_at', '<=', $request->end_date))
        ->latest()->get();

    return view('laporan.transaksi', compact('transaksi'));
}

    public function exportStokPDF() {
    $barang = \App\Models\Barang::all();
    $pdf = PDF::loadView('exports.stok_pdf', compact('barang'));
    return $pdf->download('laporan_stok.pdf');
}

public function exportTransaksiPDF(Request $request) {
    $transaksi = $this->filterTransaksi($request);
    $pdf = PDF::loadView('exports.transaksi_pdf', compact('transaksi'));
    return $pdf->download('laporan_transaksi.pdf');
}

public function exportStokExcel() {
    return Excel::download(new StokExport, 'laporan_stok.xlsx');
}

public function exportTransaksiExcel(Request $request) {
    return Excel::download(new TransaksiExport($request->start_date, $request->end_date), 'laporan_transaksi.xlsx');
}

private function filterTransaksi($request) {
    return \App\Models\Transaksi::with('barang')
        ->when($request->start_date, fn($q) => $q->whereDate('created_at', '>=', $request->start_date))
        ->when($request->end_date, fn($q) => $q->whereDate('created_at', '<=', $request->end_date))
        ->latest()->get();
}

}
