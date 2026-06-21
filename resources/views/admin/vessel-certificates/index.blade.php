@extends('layouts.admin')

@section('title', 'Certificate Monitoring')

@section('content_header')
    <h1>Certificate Monitoring</h1>
@stop

@section('content')

<a href="/admin/vessel-certificates/create" class="btn btn-primary mb-3">
    Tambah Certificate
</a>

<a href="/admin/vessel-certificates-export"
                class="btn btn-success mb-3">
                    Export Excel
                </a>

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>No</th>
            <th>Kapal</th>
            <th>Certificate</th>
            <th>Issued Date</th>
            <th>Expired Date</th>
            <th>Days Remaining</th>
            <th>Status</th>
            <th>Remarks</th>
        </tr>
    </thead>

    <tbody>
        @foreach($data as $item)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $item->location->name ?? '-' }}</td>
            <td>{{ $item->certificate_name }}</td>
            <td>{{ $item->issued_date }}</td>
            <td>{{ $item->expired_date }}</td>
            <td>{{ $item->days_valid }}</td>
            <td>
                @if($item->status == 'Expired')
                    <span class="badge bg-danger">Expired</span>
                @elseif($item->status == 'Expiring Soon')
                    <span class="badge bg-warning">Expiring Soon</span>
                @else
                    <span class="badge bg-success">Valid</span>
                @endif
            </td>
            <td>{{ $item->remarks }}</td>

        </tr>
        @endforeach
    </tbody>
</table>

@stop