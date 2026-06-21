<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IncidentResume;
use App\Models\MasterLocation;

class IncidentResumeController extends Controller
{
    public function index()
    {
        $data = IncidentResume::with('location')->get();

        return view(
            'admin.incident-resume.index',
            compact('data')
        );
    }

    public function create()
    {
        $locations = MasterLocation::all();

        return view(
            'admin.incident-resume.create',
            compact('locations')
        );
    }

    public function store(Request $request)
    {
        IncidentResume::create($request->all());

        return redirect('/admin/incident-resume')
            ->with('success', 'Data berhasil ditambah');
    }
}