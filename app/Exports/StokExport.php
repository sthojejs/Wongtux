<?php 

namespace App\Exports;

use App\Models\Barang;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class StokExport implements FromCollection, WithHeadings
{
    public function collection() {
        return Barang::select('nama', 'kategori', 'kode', 'stok')->get();
    }

    public function headings(): array {
        return ['Nama', 'Kategori', 'Kode', 'Stok'];
    }
}
