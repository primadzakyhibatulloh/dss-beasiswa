<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class RankingMahasiswaExport implements FromCollection, WithHeadings
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        return $this->data->map(function ($item) {
            return [
                'Nama Peserta' => $item->nama_peserta,
                'Nilai Core Factor' => number_format($item->nilai_core_factor, 2),
                'Nilai Secondary Factor' => number_format($item->nilai_secondary_factor, 2),
                'Nilai Total' => number_format($item->nilai_total, 2),
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Nama Peserta',
            'Nilai Core Factor',
            'Nilai Secondary Factor',
            'Nilai Total',
        ];
    }
}
