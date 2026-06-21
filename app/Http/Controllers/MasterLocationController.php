<?php

namespace App\Http\Controllers;

use App\Models\MasterLocation;
use Illuminate\Http\Request;

class MasterLocationController extends Controller
{
     public function index()
    {
        $data = MasterLocation::all();

        return view(
            'admin.master-location.index',
            compact('data')
        );
    }

    public function create()
    {
        return view('admin.master-location.create');
    }

    public function store(Request $request)
    {
        MasterLocation::create($request->all());

        return redirect('/admin/master-location')
            ->with('success', 'Data berhasil ditambah');
    }

    /**
     * Display the specified resource.
     */
    public function show(MasterLocation $masterLocation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MasterLocation $masterLocation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MasterLocation $masterLocation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MasterLocation $masterLocation)
    {
        //
    }
}
