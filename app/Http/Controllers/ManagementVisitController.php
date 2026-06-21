<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ManagementVisit;
use App\Models\MasterLocation;

class ManagementVisitController extends Controller
{
    public function index()
    {
        $data = ManagementVisit::with('location')->get();

        return view(
            'admin.management-visits.index',
            compact('data')
        );
    }

    public function create()
    {
        $locations = MasterLocation::all();

        return view(
            'admin.management-visits.create',
            compact('locations')
        );
    }

    public function store(Request $request)
    {
        ManagementVisit::create($request->all());

        return redirect('/admin/management-visits')
            ->with('success', 'Data berhasil ditambah');
    }
}