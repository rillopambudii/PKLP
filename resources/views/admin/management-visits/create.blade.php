@extends('layouts.admin')

@section('title', 'Tambah Management Visit')

@section('content_header')
    <h1>Tambah Management Visit</h1>
@stop

@section('content')

<form action="/admin/management-visits" method="POST">
    @csrf

    <div class="form-group mb-3">
        <label>Tanggal Kunjungan</label>
        <input type="date" name="visit_date" class="form-control">
    </div>

    <div class="form-group mb-3">
        <label>Peserta</label>
        <input type="text" name="participant" class="form-control">
    </div>

    <div class="form-group mb-3">
        <label>Lokasi / Armada yang Dikunjungi</label>
        <select name="master_location_id" class="form-control">
            @foreach($locations as $location)
                <option value="{{ $location->id }}">
                    {{ $location->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="form-group mb-3">
        <label>Tujuan Kunjungan</label>
        <textarea name="visit_purpose" class="form-control" rows="3"></textarea>
    </div>

    <div class="form-group mb-3">
        <label>Temuan / Observasi</label>
        <textarea name="findings" class="form-control" rows="3"></textarea>
    </div>

    <div class="form-group mb-3">
        <label>Tindakan Koreksi / Rencana Tindak Lanjut</label>
        <textarea name="corrective_action" class="form-control" rows="3"></textarea>
    </div>

    <div class="form-group mb-3">
        <label>Penanggung Jawab</label>
        <input type="text" name="person_in_charge" class="form-control">
    </div>

    <div class="form-group mb-3">
        <label>Target Waktu</label>
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

    <div class="form-group mb-3">
        <label>Tahun</label>
        <input type="number" name="year" class="form-control" value="{{ date('Y') }}">
    </div>

    <button class="btn btn-success">Simpan</button>
</form>

@stop