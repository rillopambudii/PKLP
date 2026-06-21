@extends('layouts.admin')

@section('title', 'Management Review')

@section('content_header')
    <h1>Management Review</h1>
@stop

@section('content')

<a href="/admin/management-reviews/create"
   class="btn btn-primary mb-3">
    Tambah Data
</a>

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>No</th>
            <th>Tanggal Rapat</th>
            <th>Topik</th>
            <th>PIC</th>
            <th>Status</th>
            <th>Target</th>
            <th>Realisasi</th>
            <th>Catatan</th>
        </tr>
    </thead>

    <tbody>
        @foreach($data as $item)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $item->meeting_date }}</td>
            <td>{{ $item->topic }}</td>
            <td>{{ $item->person_in_charge }}</td>
            <td>
               @php

                $isOverdue =
                    $item->follow_up_status == 'Open' && $item->target_date &&
                    \Carbon\Carbon::parse(
                        $item->target_date
                    )->isPast();

            @endphp

            @if($item->follow_up_status == 'Closed')

                <span class="badge bg-success">

                    Closed

                </span>

            @elseif($isOverdue)

                <span class="badge bg-danger">

                    Overdue

                </span>

            @else

                <span class="badge bg-warning">

                    Open

                </span>

            @endif
            </td>
            <td>{{ $item->target_date }}</td>
            <td>{{ $item->realization_date }}</td>
            <td>{{ $item->additional_notes }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

@stop