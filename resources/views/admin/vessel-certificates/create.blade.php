@extends('layouts.admin')

@section('title', 'Tambah Certificate')

@section('content_header')
    <h1>Tambah Certificate</h1>
@stop

@section('content')

<form action="/admin/vessel-certificates" method="POST">
    @csrf

    <div class="form-group mb-3">
        <label>Kapal</label>
        <select name="master_location_id" class="form-control">
            @foreach($locations as $location)
                <option value="{{ $location->id }}">
                    {{ $location->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="form-group mb-3">
        <label>Certificate Name</label>
        <input type="text" name="certificate_name" class="form-control">
    </div>

    <div class="form-group mb-3">
        <label>Issue Place</label>
        <input type="text" name="issue_place" class="form-control">
    </div>

    <div class="form-group mb-3">
        <label>Issued Date</label>
        <input type="date" name="issued_date" class="form-control">
    </div>

    <div class="form-group mb-3">
        <label>Expired Date</label>
        <input type="date" name="expired_date" class="form-control">
    </div>

    <div class="form-group mb-3">
        <label>Remarks</label>
        <textarea name="remarks" class="form-control" rows="3"></textarea>
    </div>

    <div class="form-group mb-3">
        <label>Year</label>
        <input type="number" name="year" class="form-control" value="{{ date('Y') }}">
    </div>

    <button class="btn btn-success">Simpan</button>
</form>

@stop