<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VesselCertificate;
use App\Models\MasterLocation;
use Carbon\Carbon;
use App\Exports\VesselCertificatesExport;
use Maatwebsite\Excel\Facades\Excel;

class VesselCertificateController extends Controller
{
    public function index()
    {
        $data = VesselCertificate::with('location')->get();

        return view(
            'admin.vessel-certificates.index',
            compact('data')
        );
    }

    public function create()
    {
        $locations = MasterLocation::all();

        return view(
            'admin.vessel-certificates.create',
            compact('locations')
        );
    }

    public function store(Request $request)
    {
        $expiredDate = Carbon::parse(
            $request->expired_date
        );

        $daysValid = now()->diffInDays(
            $expiredDate,
            false
        );

        if ($daysValid < 0) {

            $status = 'Expired';

        } elseif ($daysValid <= 30) {

            $status = 'Expiring Soon';

        } else {

            $status = 'Valid';
        }

        VesselCertificate::create([

            'master_location_id' =>
                $request->master_location_id,

            'certificate_name' =>
                $request->certificate_name,

            'issue_place' =>
                $request->issue_place,

            'issued_date' =>
                $request->issued_date,

            'expired_date' =>
                $request->expired_date,

            'days_valid' =>
                $daysValid,

            'status' =>
                $status,

            'remarks' =>
                $request->remarks,

            'year' =>
                $request->year,
        ]);

        return redirect('/admin/vessel-certificates')
            ->with('success', 'Certificate berhasil ditambah');
    }
    public function exportExcel()
    {
        return Excel::download(
            new VesselCertificatesExport,
            'certificate-monitoring.xlsx'
        );
    }
}