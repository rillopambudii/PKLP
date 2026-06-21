<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MaintenanceChecklist;
use App\Models\MasterLocation;
use App\Models\MaintenanceItem;
use App\Models\MaintenanceDailyCheck;

class MaintenanceChecklistController extends Controller
{
    public function index()
    {
        $data = MaintenanceChecklist::with('location')->get();

        return view(
            'admin.maintenance-checklists.index',
            compact('data')
        );
    }

    public function create()
    {
        $locations = MasterLocation::all();

        return view(
            'admin.maintenance-checklists.create',
            compact('locations')
        );
    }

    public function store(Request $request)
    {
        MaintenanceChecklist::create($request->all());

        return redirect('/admin/maintenance-checklists')
            ->with('success', 'Maintenance checklist berhasil ditambah');
    }

    public function items($id)
    {
        $checklist = MaintenanceChecklist::with('location')
            ->findOrFail($id);

        $items = MaintenanceItem::where(
            'maintenance_checklist_id',
            $id
        )->get();

        return view(
            'admin.maintenance-checklists.items',
            compact('checklist', 'items')
        );
    }

    public function storeItem(Request $request, $id)
    {
        MaintenanceItem::create([

            'maintenance_checklist_id' => $id,

            'equipment' =>
                $request->equipment,

            'item_no' =>
                $request->item_no,

            'item_name' =>
                $request->item_name,

            'task_description' =>
                $request->task_description,

            'periodical_standard' =>
                $request->periodical_standard,

            'monitor_by' =>
                $request->monitor_by,

            'remarks' =>
                $request->remarks,
        ]);

        return back()->with(
            'success',
            'Maintenance item berhasil ditambah'
        );
    }

    public function storeDailyCheck(Request $request, $id)
    {
        MaintenanceDailyCheck::updateOrCreate(
            [
                'maintenance_item_id' => $id,
                'check_date' => $request->check_date,
            ],
            [
                'status' => $request->status,
                'note' => $request->note,
            ]
        );

        return back()->with('success', 'Daily check berhasil disimpan');
    }
}