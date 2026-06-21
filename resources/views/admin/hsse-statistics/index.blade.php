@extends('layouts.admin')

@section('title', 'HSSE Statistics')

@section('content_header')
    <h1>HSSE Statistics</h1>
@stop

@section('content')

<a href="/admin/hsse-statistics/create"
   class="btn btn-primary mb-3">

    Tambah Data

</a>

<table class="table table-bordered">

    <thead>
        <tr>
            <th>No</th>
            <th>Lokasi</th>
            <th>Bulan</th>
            <th>Tahun</th>
            <th class="text-right">Nearmiss</th>
            <th class="text-right">Environment</th>
            <th class="text-right">LTI</th>
            <th class="text-right">Fatality</th>
            <th class="text-right">Incident Total</th>
            <th class="text-right">LTIFR</th>
            <th class="text-right">MTIFR</th>
            <th class="text-right">%LTI</th>
        </tr>
    </thead>

    <tbody>

        @foreach($data as $item)

        @php

            $incidentTotal =
                $item->nearmiss +
                $item->environment +
                $item->property_damage +
                $item->hipo +
                $item->first_aid +
                $item->medical_treatment +
                $item->lti +
                $item->fatality;

            $manHours =
                \App\Models\ManHour::where(
                    'master_location_id',
                    $item->master_location_id
                )
                ->where('month', $item->month)
                ->where('year', $item->year)
                ->sum('man_hours');

            $ltifr =
                $manHours > 0
                ? ($item->lti * 1000000) / $manHours
                : 0;

            $mtifr =
                $manHours > 0
                ? ($item->medical_treatment * 1000000) / $manHours
                : 0;

            $percentLti =
                $incidentTotal > 0
                ? ($item->lti / $incidentTotal) * 100
                : 0;

        @endphp

        <tr>

            <td>{{ $loop->iteration }}</td>

            <td>
                {{ $item->location->name ?? '-' }}
            </td>

            <td>{{ $item->month }}</td>

            <td>{{ $item->year }}</td>

            <td class="text-right">{{ $item->nearmiss }}</td>

            <td class="text-right">{{ $item->environment }}</td>

            <td class="text-right">{{ $item->lti }}</td>

            <td class="text-right">{{ $item->fatality }}</td>

            <td class="text-right">{{ $incidentTotal }}</td>

            <td class="text-right">
                {{ number_format($ltifr, 2) }}
            </td>

            <td class="text-right">
                {{ number_format($mtifr, 2) }}
            </td>

            <td class="text-right">
                {{ number_format($percentLti, 2) }}%
            </td>

        </tr>

        @endforeach

    </tbody>

</table>

@stop