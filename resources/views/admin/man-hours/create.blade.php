@extends('layouts.admin')

@section('title', 'Tambah Man Hours')

@section('content_header')
    <h1>Tambah Man Hours</h1>
@stop

@section('content')

<form action="/admin/man-hours"
      method="POST">

    @csrf

    <div class="form-group mb-3">

        <label>Lokasi / Kapal</label>

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
       value="{{ date('Y') }}" readonly>

    </div>
    

    <div class="form-group mb-3">

        <label>Man Power</label>

        <input type="number"
               name="man_power"
               class="form-control">

    </div>

    <div class="form-group mb-3">

        <label>Man Hours</label>

        <input type="number"
               name="man_hours"
               class="form-control">

    </div>

    <button class="btn btn-success">

        Simpan

    </button>

</form>

@stop