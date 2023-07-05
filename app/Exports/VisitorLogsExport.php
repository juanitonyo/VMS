<?php

namespace App\Exports;

use App\Models\VisitorLogs;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class VisitorLogsExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return VisitorLogs::all();
    }

    public function headings(): array
    {
        return ["id", "visitor_id", "user_id", "building_id", "visit_purpose_id", "log_type", "checked_in_by", "checked_out_by", "health_form", "is_checked_out", "status", "created_at", "updated_at"];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1    => ['font' => ['bold' => true]],
        ];
    }
    
}
