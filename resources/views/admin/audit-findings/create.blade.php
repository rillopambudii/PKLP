@extends('layouts.admin')

@section('title', 'Tambah Audit Finding')

@section('content_header')
    <h1>Tambah Audit Finding</h1>
@stop

@section('content')

<form action="/admin/audit-findings" method="POST">
    @csrf

    <div class="form-group mb-3">
        <label>Audit</label>
        <select name="internal_audit_id" class="form-control">
            @foreach($audits as $audit)
                <option value="{{ $audit->id }}">
                    {{ $audit->audit_type }}
                    -
                    {{ $audit->location->name ?? $audit->department ?? '-' }}
                    -
                    {{ $audit->audit_date }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="form-group mb-3">
        <label>Klausul</label>
        <input type="text" name="clause" class="form-control">
    </div>

    <div class="form-group mb-3">
        <label>Deskripsi Temuan</label>
        <textarea name="finding_description" class="form-control" rows="4"></textarea>
    </div>

    <div class="form-group mb-3">
        <label>Tipe Temuan</label>
        <select name="finding_type" class="form-control">
            <option>OFI</option>
            <option>Obs</option>
            <option>Minor</option>
            <option>Major</option>
        </select>
    </div>

    <div class="form-group mb-3">
        <label>Tindakan Perbaikan</label>
        <textarea name="corrective_action" class="form-control" rows="3"></textarea>
    </div>

    <div class="form-group mb-3">
        <label>Penanggung Jawab</label>
        <input type="text" name="person_in_charge" class="form-control">
    </div>

    <div class="form-group mb-3">
        <label>Target Penyelesaian</label>
        <input type="date" name="target_date" class="form-control">
    </div>

    <div class="form-group mb-3">
        <label>Status</label>
        <select name="status" class="form-control">
            <option>Open</option>
            <option>Closed</option>
        </select>
    </div>

    <div class="form-group mb-3">
        <label>Tanggal Penyelesaian</label>
        <input type="date" name="completion_date" class="form-control">
    </div>

    <button class="btn btn-success">Simpan</button>
</form>

@stop