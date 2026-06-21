<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AnnualWorkPlan;
use App\Models\AnnualWorkPlanSchedule;

class AnnualWorkPlanController extends Controller
{
    public function index()
    {
        $data = AnnualWorkPlan::all();

        return view(
            'admin.annual-work-plans.index',
            compact('data')
        );
    }

    public function create()
    {
        return view(
            'admin.annual-work-plans.create'
        );
    }

    public function store(Request $request)
    {
        AnnualWorkPlan::create($request->all());

        return redirect('/admin/annual-work-plans')
            ->with('success', 'Data berhasil ditambah');
    }

    public function schedules($id)
    {
        $plan = AnnualWorkPlan::with('schedules')
            ->findOrFail($id);

        $months = [

            'Jan',
            'Feb',
            'Mar',
            'Apr',
            'May',
            'Jun',
            'Jul',
            'Aug',
            'Sep',
            'Oktober',
            'Nopember',
            'Desember'
        ];

        return view(

            'admin.annual-work-plans.schedules',

            compact(
                'plan',
                'months'
            )
        );
    }

    public function storeSchedule( Request $request,$id)
    {
        AnnualWorkPlanSchedule::create([

            'annual_work_plan_id' => $id,

            'month' => $request->month,

            'week' => $request->week,

            'actual_date' => $request->actual_date,

            'is_planned' => true,
        ]);

        return back()
            ->with('success', 'Schedule ditambahkan');
    }
}