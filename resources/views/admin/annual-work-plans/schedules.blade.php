@extends('layouts.admin')

@section('title', 'Schedule')

@section('content_header')

<h1>
    Schedule :
    {{ $plan->activity_name }}
</h1>

@stop

@section('content')
<div class="card mb-3">

    <div class="card-body">

        <form method="POST"
              action="/admin/annual-work-plans/{{ $plan->id }}/schedules">

            @csrf

            <div class="row">

                <div class="col-md-4">

                    <label>Month</label>

                    <select name="month"
                            class="form-control">

                        <option>Jan</option>
                        <option>Feb</option>
                        <option>Mar</option>
                        <option>Apr</option>
                        <option>May</option>
                        <option>Jun</option>
                        <option>Jul</option>
                        <option>Aug</option>
                        <option>Sep</option>
                        <option>Oktober</option>
                        <option>Nopember</option>
                        <option>Desember</option>

                    </select>

                </div>

                <div class="col-md-4">

                    <label>Week</label>

                    <select name="week"
                            class="form-control">

                        <option value="1">W1</option>
                        <option value="2">W2</option>
                        <option value="3">W3</option>
                        <option value="4">W4</option>

                    </select>

                </div>
                <div class="col-md-4">

                    <label>Actual Date</label>

                    <input type="date"
                        name="actual_date"
                        class="form-control">

                </div>

                <div class="col-md-4">

                    <label>&nbsp;</label>

                    <button class="btn btn-primary d-block">

                        Tambah Schedule

                    </button>

                </div>

            </div>

        </form>

    </div>

</div>

<table class="table table-bordered">

    <thead>

        <tr>

            <th>Month</th>

            <th>W1</th>
            <th>W2</th>
            <th>W3</th>
            <th>W4</th>

        </tr>

    </thead>

    <tbody>

        @foreach($months as $month)

        <tr>

            <td>{{ $month }}</td>

            @for($week = 1; $week <= 4; $week++)

                @php

                    $schedule = $plan->schedules
                        ->where('month', $month)
                        ->where('week', $week)
                        ->first();

                @endphp

                <td class="text-center">

                   @if($schedule)

                        <span class="badge bg-success">

                            {{ $schedule->actual_date
                                ? date(
                                    'd-M-Y',
                                    strtotime($schedule->actual_date)
                                )
                                : 'Planned'
                            }}

                        </span>

                    @endif

                </td>

            @endfor

        </tr>

        @endforeach

    </tbody>

</table>

@stop
@include('partials.logout-script')