@extends('layouts.admin')

@section('title', 'Tambah Lokasi')

@section('content_header')
    <h1>Tambah Lokasi</h1>
@stop

@section('content')

<form action="/admin/master-location"
      method="POST">

    @csrf

    <div class="form-group mb-3">

        <label>Area</label>

        <input type="text"
               name="area"
               class="form-control">

    </div>

    <div class="form-group mb-3">

        <label>Location</label>

        <input type="text"
               name="location"
               class="form-control">

    </div>

    <div class="form-group mb-3">

        <label>Name</label>

        <input type="text"
               name="name"
               class="form-control">

    </div>

    <div class="form-group mb-3">

        <label>Type</label>

        <select name="type"
                class="form-control">

            <option value="Vessel">
                Vessel
            </option>

            <option value="Shore">
                Shore
            </option>

        </select>

    </div>

    <button class="btn btn-success">
        Simpan
    </button>

</form>

@stop