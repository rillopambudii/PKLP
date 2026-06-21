@extends('layouts.admin')

@section('title', 'Maintenance Checklist')

@section('content_header')
    <h1>Maintenance Checklist</h1>
@stop

@section('content')

<a href="/admin/maintenance-checklists/create"
   class="btn btn-primary mb-3">

    Tambah Maintenance

</a>

<table class="table table-bordered table-striped">

    <thead>
        <tr>
            <th>No</th>
            <th>Tipe</th>
            <th>Kapal</th>
            <th>Bulan</th>
            <th>Tahun</th>
            <th>Department</th>
            <th>Monitored By</th>
            <th>Remarks</th>
            <th>Action</th>
        </tr>
    </thead>

    <tbody>

        @foreach($data as $item)

        <tr>

            <td>{{ $loop->iteration }}</td>

            <td>
                {{ $item->maintenance_type }}
            </td>

            <td>
                {{ $item->location->name ?? '-' }}
            </td>

            <td>
                {{ $item->month }}
            </td>

            <td>
                {{ $item->year }}
            </td>

            <td>
                {{ $item->department }}
            </td>

            <td>
                {{ $item->monitored_by }}
            </td>

            <td>
                {{ $item->remarks }}
            </td>
            <td>
                <a href="/admin/maintenance-checklists/{{ $item->id }}/items"
                class="btn btn-info btn-sm">

                    Items

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