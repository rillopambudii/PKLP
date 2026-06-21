@extends('layouts.admin')

@section('title', 'Incident Resume')

@section('content_header')
    <h1>Incident Resume</h1>
@stop

@section('content')

<a href="/admin/incident-resume/create"
   class="btn btn-primary mb-3">

    Tambah Incident

</a>

<table class="table table-bordered table-striped">

    <thead>

        <tr>

            <th>No</th>

            <th>Investigation Number</th>

            <th>Date</th>

            <th>Location</th>

            <th>Title</th>

            <th>Severity</th>

            <th>Status</th>

            <th>Target</th>

            <th>Completion</th>

        </tr>

    </thead>

    <tbody>

        @foreach($data as $item)

        <tr>

            <td>{{ $loop->iteration }}</td>

            <td>
                {{ $item->investigation_number }}
            </td>

            <td>
                {{ $item->incident_date }}
            </td>

            <td>
                {{ $item->location->name ?? '-' }}
            </td>

            <td>
                {{ $item->title_of_incident }}
            </td>

            <td>
                {{ $item->severity_level }}
            </td>

            <td>

                @if($item->investigation_status == 'Open')

                    <span class="badge bg-danger">

                        Open

                    </span>

                @else

                    <span class="badge bg-success">

                        Closed

                    </span>

                @endif

            </td>

            <td>
                {{ $item->completion_target }}
            </td>

            <td>
                {{ $item->completion_date }}
            </td>

        </tr>

        @endforeach

    </tbody>

</table>

@stop