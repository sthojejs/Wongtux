<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Imports\BarangImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BarangController extends Controller
{
    public function index()
    {
        $barang = Barang::with('kategori')->get();

        return view('barang.index', compact('barang'));
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls'
        ]);

        Excel::import(new BarangImport, $request->file('file'));

        $failedKategori = session()->pull('import_failed_kategori', []);

        if (!empty($failedKategori)) {
            return redirect()->route('barang.index')
                ->with('warning', 'Beberapa data tidak diimpor karena kategori_id berikut tidak ditemukan: ' . implode(', ', $failedKategori));
        }

        return redirect()->route('barang.index')->with('success', 'Data barang berhasil diimpor!');
    }

    public function downloadTemplate()
    {
        return Excel::download(new class implements FromCollection, WithHeadings {
            public function collection()
            {
                return collect([]);
            }

            public function headings(): array
            {
                return ['nama', 'kategori_id', 'kode', 'deskripsi', 'stok'];
            }
        }, 'template_barang.xlsx');
    }

    public function create()
    {
        $kategori = Kategori::all();

        return view('barang.create', compact('kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'        => 'required',
            'kategori_id' => 'required|exists:kategori,id',
            'kode'        => 'required|unique:barang',
            'stok'        => 'required|numeric',
        ]);

        Barang::create($request->all());

        return redirect()->route('barang.index')->with('success', 'Barang berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $barang = Barang::findOrFail($id);
        $kategori = Kategori::all();

        return view('barang.edit', compact('barang', 'kategori'));
    }

    public function update(Request $request, $id)
    {
        $barang = Barang::findOrFail($id);

        $request->validate([
            'nama'        => 'required',
            'kategori_id' => 'required|exists:kategori,id',
            'kode'        => 'required|unique:barang,kode,' . $barang->id,
            'stok'        => 'required|numeric',
        ]);

        $barang->update($request->all());

        return redirect()->route('barang.index')->with('success', 'Barang berhasil diupdate.');
    }

    public function destroy($id)
    {
        $barang = Barang::findOrFail($id);
        $barang->delete();

        return redirect()->route('barang.index')->with('success', 'Barang berhasil dihapus.');
    }
}
