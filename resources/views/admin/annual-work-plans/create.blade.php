@extends('layouts.admin')

@section('title', 'Tambah Program')

@section('content_header')
    <h1>Tambah Annual Work Plan</h1>
@stop

@section('content')

<form action="/admin/annual-work-plans"
      method="POST">

    @csrf

    <div class="form-group mb-3">

        <label>Activity Name</label>

        <input type="text"
               name="activity_name"
               class="form-control">

    </div>

    <div class="form-group mb-3">

        <label>Sub Activity</label>

        <input type="text"
               name="sub_activity"
               class="form-control">

    </div>

    <div class="form-group mb-3">

        <label>Participant</label>

        <input type="text"
               name="participant"
               class="form-control">

    </div>

    <div class="form-group mb-3">

        <label>Frequency</label>

        <select name="frequency"
                class="form-control">

            <option>Monthly</option>
            <option>Quarterly</option>
            <option>Semester</option>
            <option>Yearly</option>

        </select>

    </div>

    <div class="form-group mb-3">

        <label>Year</label>

        <input type="number"
               name="year"
               class="form-control"
               value="{{ date('Y') }}">

    </div>

    <div class="form-group mb-3">

        <label>Notes</label>

        <textarea name="notes"
                  class="form-control"
                  rows="4"></textarea>

    </div>

    <button class="btn btn-success">

        Simpan

    </button>

</form>

@stop
@include('partials.logout-script')