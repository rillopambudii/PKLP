@extends('layouts.admin')

@section('title', 'Internal Audit')

@section('content_header')
    <h1>Internal Audit</h1>
@stop

@section('content')

<a href="/admin/internal-audits/create" class="btn btn-primary mb-3">
    Tambah Audit
</a>

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>No</th>
            <th>Tipe Audit</th>
            <th>Tanggal</th>
            <th>Lokasi / Kapal</th>
            <th>Department</th>
            <th>Auditor</th>
            <th>Auditee</th>
            <th>Status</th>
            <th>Tahun</th>
            <th>Action</th>
        </tr>
    </thead>

    <tbody>
        @foreach($data as $item)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $item->audit_type }}</td>
            <td>{{ $item->audit_date }}</td>
            <td>{{ $item->location->name ?? '-' }}</td>
            <td>{{ $item->department }}</td>
            <td>{{ $item->auditor }}</td>
            <td>{{ $item->auditee }}</td>
            <td>
                @if($item->status == 'Closed')
                    <span class="badge bg-success">Closed</span>
                @else
                    <span class="badge bg-warning">Open</span>
                @endif
            </td>
            <td>{{ $item->year }}</td>
            <td>
                <a href="/admin/internal-audits/{{ $item->id }}/checklist"
                class="btn btn-info btn-sm">
                    Checklist
                </a>
                <a href="/admin/internal-audits/{{ $item->id }}/export-pdf"
                class="btn btn-danger btn-sm">
                    PDF
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@stop