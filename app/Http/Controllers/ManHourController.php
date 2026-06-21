<?php

namespace App\Http\Controllers;

use App\Models\ManHour;
use App\Models\MasterLocation;
use Illuminate\Http\Request;

class ManHourController extends Controller
{
    public function index()
    {
        $data = ManHour::with('location')->get();

        return view(
            'admin.man-hours.index',
            compact('data')
        );
    }

    public function create()
    {
        $locations = MasterLocation::all();

        return view(
            'admin.man-hours.create',
            compact('locations')
        );
    }

    public function store(Request $request)
    {
        ManHour::create($request->all());

        return redirect('/admin/man-hours')
            ->with('success', 'Data berhasil ditambah');
    }
}