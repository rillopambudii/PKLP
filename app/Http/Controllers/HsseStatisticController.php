<?php

namespace App\Http\Controllers;

use App\Models\HsseStatistic;
use App\Models\MasterLocation;
use Illuminate\Http\Request;

class HsseStatisticController extends Controller
{
    public function index()
    {
        $data = HsseStatistic::with('location')->get();

        return view(
            'admin.hsse-statistics.index',
            compact('data')
        );
    }

    public function create()
    {
        $locations = MasterLocation::all();

        return view(
            'admin.hsse-statistics.create',
            compact('locations')
        );
    }

    public function store(Request $request)
    {
        HsseStatistic::create($request->all());

        return redirect('/admin/hsse-statistics')
            ->with('success', 'Data berhasil ditambah');
    }
}