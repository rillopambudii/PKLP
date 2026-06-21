@extends('layouts.admin')

@section('title', 'Management Visit')

@section('content_header')
    <h1>Management Visit</h1>
@stop

@section('content')

<a href="/admin/management-visits/create" class="btn btn-primary mb-3">
    Tambah Kunjungan
</a>

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Peserta</th>
            <th>Lokasi / Armada</th>
            <th>Tujuan</th>
            <th>Temuan</th>
            <th>PIC</th>
            <th>Target</th>
            <th>Status</th>
            <th>Penyelesaian</th>
        </tr>
    </thead>

    <tbody>
        @foreach($data as $item)

        @php
            $isOverdue =
                $item->status == 'Open'
                && $item->target_date
                && \Carbon\Carbon::parse($item->target_date)->isPast();
        @endphp

        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $item->visit_date }}</td>
            <td>{{ $item->participant }}</td>
            <td>{{ $item->location->name ?? '-' }}</td>
            <td>{{ $item->visit_purpose }}</td>
            <td>{{ $item->findings }}</td>
            <td>{{ $item->person_in_charge }}</td>
            <td>{{ $item->target_date }}</td>
            <td>
                @if($item->status == 'Closed')
                    <span class="badge bg-success">Closed</span>
                @elseif($isOverdue)
                    <span class="badge bg-danger">Overdue</span>
                @else
                    <span class="badge bg-warning">Open</span>
                @endif
            </td>
            <td>{{ $item->completion_date }}</td>
        </tr>

        @endforeach
    </tbody>
</table>

@stop