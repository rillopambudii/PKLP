@extends('layouts.admin')

@section('title', 'Tambah Internal Audit')

@section('content_header')
    <h1>Tambah Internal Audit</h1>
@stop

@section('content')

<form action="/admin/internal-audits" method="POST">
    @csrf

    <div class="form-group mb-3">
        <label>Tipe Audit</label>
        <select name="audit_type" class="form-control">
            <option value="Vessel">Vessel</option>
            <option value="Office">Office</option>
        </select>
    </div>

    <div class="form-group mb-3">
        <label>Tanggal Audit</label>
        <input type="date" name="audit_date" class="form-control">
    </div>

    <div class="form-group mb-3">
        <label>Lokasi / Kapal</label>
        <select name="master_location_id" class="form-control">
            <option value="">- Tidak Ada -</option>
            @foreach($locations as $location)
                <option value="{{ $location->id }}">
                    {{ $location->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="form-group mb-3">
        <label>Department</label>
        <input type="text" name="department" class="form-control">
    </div>

    <div class="form-group mb-3">
        <label>Auditor</label>
        <input type="text" name="auditor" class="form-control">
    </div>

    <div class="form-group mb-3">
        <label>Auditee</label>
        <input type="text" name="auditee" class="form-control">
    </div>

    <div class="form-group mb-3">
        <label>Status</label>
        <select name="status" class="form-control">
            <option>Open</option>
            <option>Closed</option>
        </select>
    </div>

    <div class="form-group mb-3">
        <label>Tahun</label>
        <input type="number" name="year" class="form-control" value="{{ date('Y') }}">
    </div>

    <button class="btn btn-success">Simpan</button>
</form>

@stop