<?php 

namespace App\Exports;

use App\Models\Barang;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class StokExport implements FromCollection, WithHeadings
{
    public function collection() {
        return Barang::select('nama', 'kategori_id', 'kode', 'stok', 'deskripsi')->get();
    }

    public function headings(): array {
        return ['Nama', 'Kategori_id', 'Kode', 'Stok', 'deskripsi'];
    }
}
