@extends('layouts.admin')

@section('title', 'Audit Findings')

@section('content_header')
    <h1>Audit Findings</h1>
@stop

@section('content')

<a href="/admin/audit-findings/create" class="btn btn-primary mb-3">
    Tambah Temuan
</a>

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>No</th>
            <th>Audit</th>
            <th>Klausul</th>
            <th>Temuan</th>
            <th>Tipe</th>
            <th>PIC</th>
            <th>Target</th>
            <th>Status</th>
            <th>Completion</th>
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
            <td>
                {{ $item->audit->audit_type ?? '-' }}
                -
                {{ $item->audit->location->name ?? $item->audit->department ?? '-' }}
            </td>
            <td>{{ $item->clause }}</td>
            <td>{{ $item->finding_description }}</td>
            <td>{{ $item->finding_type }}</td>
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