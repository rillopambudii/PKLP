<?php

namespace App\Exports;

use App\Models\VesselCertificate;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class VesselCertificatesExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return VesselCertificate::with('location')
            ->get()
            ->map(function ($item) {
                return [
                    'kapal' => $item->location->name ?? '-',
                    'certificate_name' => $item->certificate_name,
                    'issue_place' => $item->issue_place,
                    'issued_date' => $item->issued_date,
                    'expired_date' => $item->expired_date,
                    'days_remaining' => $item->days_valid,
                    'status' => $item->status,
                    'remarks' => $item->remarks,
                ];
            });
    }

    public function headings(): array
    {
        return [
            'Kapal',
            'Certificate Name',
            'Issue Place',
            'Issued Date',
            'Expired Date',
            'Days Remaining',
            'Status',
            'Remarks',
        ];
    }
}