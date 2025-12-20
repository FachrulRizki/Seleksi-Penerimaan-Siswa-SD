<?php

namespace App\Exports;

use App\Models\HasilUjian;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class HasilUjianExport implements 
    FromCollection, 
    WithHeadings,
    ShouldAutoSize,
    WithStyles
{
    public function collection()
    {
        return HasilUjian::with('siswa', 'siswa.pendaftaran')
            ->latest()
            ->get()
            ->map(function ($item) {
                return [
                    'Nama Siswa'     => $item->siswa->nama_lengkap,
                    'Nomor Ujian'    => $item->siswa->nomor_ujian,
                    'Jumlah Benar'   => $item->jumlah_benar,
                    'Status'         => $item->lulus ? 'LULUS' : 'TIDAK LULUS',
                    'Tanggal Ujian'  => $item->created_at->format('d-m-Y, H:i'),
                    'Nama Orang Tua' => $item->siswa->pendaftaran?->nama_orang_tua ?? '-',
                    'Alamat'         => $item->siswa->pendaftaran?->alamat ?? '-',
                ];
            });
    }

    public function headings(): array
    {
        return [
            'Nama Siswa',
            'Nomor Ujian',
            'Jumlah Benar',
            'Status',
            'Tanggal Ujian',
            'Nama Orang Tua',
            'Alamat',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $lastRow = $sheet->getHighestRow();
        $lastColumn = $sheet->getHighestColumn();

        $sheet->getStyle('A1:' . $lastColumn . '1')
            ->getFont()
            ->setBold(true);

        $sheet->getStyle('A1:' . $lastColumn . $lastRow)
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(Border::BORDER_THIN);

        $sheet->getStyle('A1:' . $lastColumn . '1')
            ->getAlignment()
            ->setHorizontal('center');

        return [];
    }
}
