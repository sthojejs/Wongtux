<?php

namespace App\Imports;

use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class BarangImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        if (!Kategori::find($row['kategori_id'])) {
            // Simpan ID yang tidak ditemukan ke dalam session
            $failed = Session::get('import_failed_kategori', []);
            $failed[] = $row['kategori_id'];
            Session::put('import_failed_kategori', array_unique($failed)); // biar tidak duplikat
            return null;
        }

        return new Barang([
            'nama'        => $row['nama'],
            'kategori_id' => $row['kategori_id'],
            'kode'        => $row['kode'],
            'deskripsi'   => $row['deskripsi'],
            'stok'        => $row['stok'],
        ]);
    }
}
