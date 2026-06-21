@extends('layouts.admin')

@section('title', 'Master Lokasi')

@section('content_header')
    <h1>Master Lokasi</h1>
@stop

@section('content')

<a href="/admin/master-location/create"
   class="btn btn-primary mb-3">

    Tambah Data

</a>

<table class="table table-bordered">

    <thead>
        <tr>
            <th>No</th>
            <th>Area</th>
            <th>Location</th>
            <th>Name</th>
            <th>Type</th>
        </tr>
    </thead>

    <tbody>

        @foreach($data as $item)

        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $item->area }}</td>
            <td>{{ $item->location }}</td>
            <td>{{ $item->name }}</td>
            <td>{{ $item->type }}</td>
        </tr>

        @endforeach

    </tbody>

</table>

@stop