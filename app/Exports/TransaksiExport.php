<?php 

namespace App\Exports;

use App\Models\Transaksi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TransaksiExport implements FromCollection, WithHeadings
{
    private $start, $end;

    public function __construct($start = null, $end = null) {
        $this->start = $start;
        $this->end = $end;
    }

    public function collection()
    {
        return Transaksi::with(['barang', 'supplier'])
            ->when($this->start, fn($q) => $q->whereDate('created_at', '>=', $this->start))
            ->when($this->end, fn($q) => $q->whereDate('created_at', '<=', $this->end))
            ->get()
            ->map(function($t) {
                return [
                    $t->created_at->format('Y-m-d'),
                    $t->barang->nama ?? '-',
                    $t->supplier->nama ?? '-',
                    $t->jenis,
                    $t->jumlah,
                    $t->keterangan,
                ];
            });
    }

    public function headings(): array
    {
        return ['Tanggal', 'Barang', 'Supplier', 'Jenis', 'Jumlah', 'Keterangan'];
    }

}
