@extends('layouts.admin')

@section('title', 'Man Hours')

@section('content_header')
    <h1>Monitoring Man Hours</h1>
@stop

@section('content')

<a href="/admin/man-hours/create"
   class="btn btn-primary mb-3">

    Tambah Data

</a>

<table class="table table-bordered">

    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Bulan</th>
            <th class="text-right">Man Power</th>
            <th class="text-right">Man Hours</th>
        </tr>
    </thead>

    <tbody>

        @foreach($data as $item)

        <tr>

            <td>{{ $loop->iteration }}</td>

            <td>
                {{ $item->location->name ?? '-' }}
            </td>

            <td>
                {{ $item->month }}
            </td>

            <td class="text-right">
                {{ number_format($item->man_power) }}
            </td>

            <td class="text-right">
                {{ number_format($item->man_hours) }}
            </td>

        </tr>

        @endforeach

    </tbody>

</table>

@stop