@extends('layouts.admin')

@section('title', 'Tambah HSSE')

@section('content_header')
    <h1>Tambah HSSE Statistics</h1>
@stop

@section('content')

<form action="/admin/hsse-statistics"
      method="POST">

    @csrf

    <div class="form-group mb-3">

        <label>Lokasi</label>

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

        <label>Nearmiss</label>

        <input type="number"
               name="nearmiss"
               class="form-control"
               value="0">

    </div>

    <div class="form-group mb-3">

        <label>Environment</label>

        <input type="number"
               name="environment"
               class="form-control"
               value="0">

    </div>

    <div class="form-group mb-3">

        <label>Property Damage</label>

        <input type="number"
               name="property_damage"
               class="form-control"
               value="0">

    </div>

    <div class="form-group mb-3">

        <label>HIPO</label>

        <input type="number"
               name="hipo"
               class="form-control"
               value="0">

    </div>

    <div class="form-group mb-3">

        <label>First Aid</label>

        <input type="number"
               name="first_aid"
               class="form-control"
               value="0">

    </div>

    <div class="form-group mb-3">

        <label>Medical Treatment</label>

        <input type="number"
               name="medical_treatment"
               class="form-control"
               value="0">

    </div>

    <div class="form-group mb-3">

        <label>LTI</label>

        <input type="number"
               name="lti"
               class="form-control"
               value="0">

    </div>

    <div class="form-group mb-3">

        <label>Fatality</label>

        <input type="number"
               name="fatality"
               class="form-control"
               value="0">

    </div>

    <button class="btn btn-success">

        Simpan

    </button>

</form>

@stop