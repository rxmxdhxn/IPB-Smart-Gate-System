<?php

namespace App\Exports;

use App\Models\VehicleLog;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class VehicleLogsExport implements FromCollection, WithHeadings, WithMapping, WithStyles, ShouldAutoSize
{
    protected $query;

    public function __construct($query)
    {
        $this->query = $query;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return $this->query->with('vehicle.user')->get();
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'No',
            'Waktu',
            'Plat Nomor',
            'Pengemudi',
            'NIM/NIP',
            'Role',
            'Tipe Kendaraan',
            'Merek',
            'Model',
            'Warna',
            'Status',
            'Catatan',
        ];
    }

    /**
     * @var VehicleLog $log
     */
    public function map($log): array
    {
        static $rowNumber = 0;
        $rowNumber++;

        return [
            $rowNumber,
            $log->logged_at->format('d/m/Y H:i:s'),
            $log->plate_number,
            $log->driver_name ?? ($log->vehicle->user->name ?? '-'),
            $log->vehicle->user->nim_nip ?? '-',
            ucfirst($log->vehicle->user->role ?? '-'),
            $log->vehicle->vehicle_type ?? '-',
            $log->vehicle->brand ?? '-',
            $log->vehicle->type ?? '-',
            $log->vehicle->color ?? '-',
            $log->type === 'in' ? 'Masuk' : 'Keluar',
            $log->notes ?? '-',
        ];
    }

    /**
     * @param Worksheet $sheet
     */
    public function styles(Worksheet $sheet)
    {
        // Style untuk header
        $sheet->getStyle('A1:L1')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'],
                'size' => 11,
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => '4a7fe5'],
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'],
                ],
            ],
        ]);

        // Border untuk semua data
        $highestRow = $sheet->getHighestRow();
        $sheet->getStyle('A1:L' . $highestRow)->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => 'CCCCCC'],
                ],
            ],
        ]);

        // Alignment untuk kolom tertentu
        $sheet->getStyle('A2:A' . $highestRow)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('B2:B' . $highestRow)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('K2:K' . $highestRow)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        // Set row height untuk header
        $sheet->getRowDimension(1)->setRowHeight(25);

        return [];
    }
}
