@extends('layouts.admin')

@section('title', 'Tambah Checklist Template')

@section('content_header')
    <h1>Tambah Checklist Template</h1>
@stop

@section('content')

<form action="/admin/audit-checklist-templates" method="POST">
    @csrf

    <div class="form-group mb-3">
        <label>Tipe Audit</label>
        <select name="audit_type" class="form-control">
            <option>Vessel</option>
            <option>Office</option>
        </select>
    </div>

    <div class="form-group mb-3">
        <label>Department</label>
        <input type="text" name="department" class="form-control" placeholder="OPS / Tech / GA / HR">
    </div>

    <div class="form-group mb-3">
        <label>Section</label>
        <input type="text" name="section" class="form-control" placeholder="Sertifikasi Kapal / Komunikasi / Kamar Mesin">
    </div>

    <div class="form-group mb-3">
        <label>Klausul</label>
        <input type="text" name="clause" class="form-control" placeholder="1.1 / 2.3 / 10.12">
    </div>

    <div class="form-group mb-3">
        <label>Pertanyaan</label>
        <textarea name="question" class="form-control" rows="4"></textarea>
    </div>

    <button class="btn btn-success">Simpan</button>
</form>

@stop