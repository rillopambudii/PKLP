<?php

namespace App\Http\Controllers;

use App\Models\AnnualWorkPlanSchedule;
use Illuminate\Http\Request;

class AnnualWorkPlanScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $plan = AnnualWorkPlan::create(
            $request->all()
        );

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

        foreach ($months as $month) {

            for ($week = 1; $week <= 4; $week++) {

                AnnualWorkPlanSchedule::create([

                    'annual_work_plan_id' => $plan->id,

                    'month' => $month,

                    'week' => $week,

                    'is_planned' => true,
                ]);
            }
        }

        return redirect('/admin/annual-work-plans')
            ->with('success', 'Data berhasil ditambah');
    }

    /**
     * Display the specified resource.
     */
    public function show(AnnualWorkPlanSchedule $annualWorkPlanSchedule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AnnualWorkPlanSchedule $annualWorkPlanSchedule)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AnnualWorkPlanSchedule $annualWorkPlanSchedule)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AnnualWorkPlanSchedule $annualWorkPlanSchedule)
    {
        //
    }
}
