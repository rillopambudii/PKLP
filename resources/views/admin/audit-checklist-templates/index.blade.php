@extends('layouts.admin')

@section('title', 'Checklist Template')

@section('content_header')
    <h1>Checklist Template</h1>
@stop

@section('content')

<a href="/admin/audit-checklist-templates/create" class="btn btn-primary mb-3">
    Tambah Pertanyaan
</a>

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>No</th>
            <th>Tipe Audit</th>
            <th>Department</th>
            <th>Section</th>
            <th>Klausul</th>
            <th>Pertanyaan</th>
        </tr>
    </thead>

    <tbody>
        @foreach($data as $item)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $item->audit_type }}</td>
            <td>{{ $item->department ?? '-' }}</td>
            <td>{{ $item->section ?? '-' }}</td>
            <td>{{ $item->clause ?? '-' }}</td>
            <td>{{ $item->question }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

@stop