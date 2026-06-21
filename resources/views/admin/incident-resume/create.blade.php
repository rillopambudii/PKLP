@extends('layouts.admin')

@section('title', 'Tambah Incident')

@section('content_header')
    <h1>Tambah Incident</h1>
@stop

@section('content')

<form action="/admin/incident-resume"
      method="POST">

    @csrf

    <div class="form-group mb-3">

        <label>Investigation Number</label>

        <input type="text"
               name="investigation_number"
               class="form-control">

    </div>

    <div class="form-group mb-3">

        <label>Date</label>

        <input type="date"
               name="incident_date"
               class="form-control">

    </div>

    <div class="form-group mb-3">

        <label>Location</label>

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

        <label>Area</label>

        <input type="text"
               name="area"
               class="form-control">

    </div>

    <div class="form-group mb-3">

        <label>Company</label>

        <input type="text"
               name="company"
               class="form-control">

    </div>

    <div class="form-group mb-3">

        <label>Title of Incident</label>

        <input type="text"
               name="title_of_incident"
               class="form-control">

    </div>

    <div class="form-group mb-3">

        <label>Incident Description</label>

        <textarea name="incident_description"
                  class="form-control"
                  rows="4"></textarea>

    </div>

    <div class="form-group mb-3">

        <label>Root Cause</label>

        <textarea name="root_cause"
                  class="form-control"
                  rows="4"></textarea>

    </div>

    <div class="form-group mb-3">

        <label>Category</label>

        <input type="text"
               name="category"
               class="form-control">

    </div>

    <div class="form-group mb-3">

        <label>Incident Category</label>

        <input type="text"
               name="incident_category"
               class="form-control">

    </div>

    <div class="form-group mb-3">

        <label>Severity Level</label>

        <select name="severity_level"
                class="form-control">

            <option>Low</option>
            <option>Medium</option>
            <option>High</option>
            <option>Critical</option>

        </select>

    </div>

    <div class="form-group mb-3">

        <label>Investigation Status</label>

        <select name="investigation_status"
                class="form-control">

            <option>Open</option>
            <option>Closed</option>

        </select>

    </div>

    <div class="form-group mb-3">

        <label>Completion Target</label>

        <input type="date"
               name="completion_target"
               class="form-control">

    </div>

    <div class="form-group mb-3">

        <label>Completion Date</label>

        <input type="date"
               name="completion_date"
               class="form-control">

    </div>

    <div class="form-group mb-3">

        <label>Year</label>

        <input type="number"
               name="year"
               class="form-control"
               value="{{ date('Y') }}">

    </div>

    <button class="btn btn-success">

        Simpan

    </button>

</form>

@stop