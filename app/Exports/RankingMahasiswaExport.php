<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class RankingMahasiswaExport implements FromCollection, WithHeadings, WithStyles, ShouldAutoSize
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        $ranking = 1; // Mulai dari ranking 1

        return $this->data->map(function ($item) use (&$ranking) {
            return [
                'Ranking' => $ranking++,
                'Nama Peserta' => $item->nama_peserta,
                'Nilai Core Factor' => $item->nilai_core_factor !== null ? number_format($item->nilai_core_factor, 2, ',', '.') : '-',
                'Nilai Secondary Factor' => $item->nilai_secondary_factor !== null ? number_format($item->nilai_secondary_factor, 2, ',', '.') : '-',
                'Nilai Total' => $item->nilai_total !== null ? number_format($item->nilai_total, 2, ',', '.') : '-',
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Ranking',
            'Nama Peserta',
            'Nilai Core Factor',
            'Nilai Secondary Factor',
            'Nilai Total',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $rowCount = $this->data->count() + 1; // +1 untuk header

        return [
            // Style header
            1 => [
                'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => '4F81BD']
                ],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                ],
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        'color' => ['rgb' => '000000'],
                    ],
                ],
            ],
            // Style data cells
            "A2:E{$rowCount}" => [
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                ],
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        'color' => ['rgb' => '000000'],
                    ],
                ],
            ],
            // Kolom Nama Peserta rata kiri
            "B2:B{$rowCount}" => [
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
                ],
            ],
        ];
    }
}
