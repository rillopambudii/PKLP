@extends('layouts.admin')

@section('title', 'Tambah Maintenance Checklist')

@section('content_header')
    <h1>Tambah Maintenance Checklist</h1>
@stop

@section('content')

<form action="/admin/maintenance-checklists"
      method="POST">

    @csrf

    <div class="form-group mb-3">

        <label>Tipe Maintenance</label>

        <select name="maintenance_type"
                class="form-control">

            <option>Deck</option>
            <option>Engine</option>

        </select>

    </div>

    <div class="form-group mb-3">

        <label>Kapal</label>

        <select name="master_location_id"
                class="form-control">

            @foreach($locations as $location)

                <option value="{{ $location->id }}">

                    {{ $location->name }}

                </option>

            @endforeach

        </select>

    </div>

    <div class="form-group mb-3">

        <label>Bulan</label>

        <select name="month"
                class="form-control">

            <option>Jan</option>
            <option>Feb</option>
            <option>Mar</option>
            <option>Apr</option>
            <option>May</option>
            <option>Jun</option>
            <option>Jul</option>
            <option>Aug</option>
            <option>Sep</option>
            <option>Oktober</option>
            <option>Nopember</option>
            <option>Desember</option>

        </select>

    </div>

    <div class="form-group mb-3">

        <label>Tahun</label>

        <input type="number"
               name="year"
               class="form-control"
               value="{{ date('Y') }}">

    </div>

    <div class="form-group mb-3">

        <label>Department</label>

        <input type="text"
               name="department"
               class="form-control">

    </div>

    <div class="form-group mb-3">

        <label>Monitored By</label>

        <input type="text"
               name="monitored_by"
               class="form-control">

    </div>

    <div class="form-group mb-3">

        <label>Remarks</label>

        <textarea name="remarks"
                  class="form-control"
                  rows="3"></textarea>

    </div>

    <button class="btn btn-success">

        Simpan

    </button>

</form>

@stop