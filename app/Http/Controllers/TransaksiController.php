<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Transaksi;

class TransaksiController extends Controller
{
    public function index() {
        $transaksi = Transaksi::with('barang')->latest()->get();
        return view('transaksi.index', compact('transaksi'));
        
    }

    public function create() {
    $barang = \App\Models\Barang::all();
    $supplier = \App\Models\Supplier::all();
    return view('transaksi.create', compact('barang', 'supplier'));

    }

    public function store(Request $request) {
        $request->validate([
            'barang_id' => 'required|exists:barang,id',
            'jenis' => 'required|in:masuk,keluar',
            'jumlah' => 'required|integer|min:1',
            'supplier_id' => 'nullable|exists:supplier,id'
        ]);

        $barang = Barang::find($request->barang_id);
        $jumlah = $request->jumlah;

        // Update stok
        if ($request->jenis == 'masuk') {
            $barang->stok += $jumlah;
        } elseif ($request->jenis == 'keluar') {
            if ($barang->stok < $jumlah) {
                return back()->withErrors(['jumlah' => 'Stok tidak mencukupi']);
            }
            $barang->stok -= $jumlah;
        }

        $barang->save();

        Transaksi::create($request->all());

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil dicatat');
    }
}
