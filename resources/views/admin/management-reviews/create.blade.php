@extends('layouts.admin')

@section('title', 'Tambah Management Review')

@section('content_header')
    <h1>Tambah Management Review</h1>
@stop

@section('content')

<form action="/admin/management-reviews" method="POST">
    @csrf

    <div class="form-group mb-3">
        <label>Tanggal Rapat</label>
        <input type="date" name="meeting_date" class="form-control">
    </div>

    <div class="form-group mb-3">
        <label>Topik yang Dibahas</label>
        <input type="text" name="topic" class="form-control">
    </div>

    <div class="form-group mb-3">
        <label>Hasil Pembahasan / Keputusan</label>
        <textarea name="discussion_result" class="form-control" rows="3"></textarea>
    </div>

    <div class="form-group mb-3">
        <label>Penanggung Jawab</label>
        <input type="text" name="person_in_charge" class="form-control">
    </div>

    <div class="form-group mb-3">
        <label>Tindak Lanjut</label>
        <textarea name="follow_up" class="form-control" rows="3"></textarea>
    </div>

    <div class="form-group mb-3">
        <label>Status Tindak Lanjut</label>
        <select name="follow_up_status" class="form-control">
            <option>Open</option>
            <option>Closed</option>
        </select>
    </div>

    <div class="form-group mb-3">
        <label>Tanggal Target</label>
        <input type="date" name="target_date" class="form-control">
    </div>

    <div class="form-group mb-3">
        <label>Tanggal Realisasi</label>
        <input type="date" name="realization_date" class="form-control">
    </div>

    <div class="form-group mb-3">
        <label>Catatan Tambahan</label>
        <textarea name="additional_notes" class="form-control" rows="3"></textarea>
    </div>

    <div class="form-group mb-3">
        <label>Tahun</label>
        <input type="number" name="year" class="form-control" value="{{ date('Y') }}">
    </div>

    <button class="btn btn-success">Simpan</button>
</form>

@stop