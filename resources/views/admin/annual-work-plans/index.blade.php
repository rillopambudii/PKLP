@extends('layouts.admin')

@section('title', 'Annual Work Plan')

@section('content_header')
    <h1>Annual Work Plan</h1>
@stop

@section('content')

<a href="/admin/annual-work-plans/create"
   class="btn btn-primary mb-3">

    Tambah Program

</a>

<table class="table table-bordered table-striped">

    <thead>

        <tr>

            <th>No</th>

            <th>Activity</th>

            <th>Sub Activity</th>

            <th>Participant</th>

            <th>Frequency</th>

            <th>Year</th>

            <th>Notes</th>
            <th>Action</th>

        </tr>

    </thead>

    <tbody>

        @foreach($data as $item)

        <tr>

            <td>{{ $loop->iteration }}</td>

            <td>
                {{ $item->activity_name }}
            </td>

            <td>
                {{ $item->sub_activity }}
            </td>

            <td>
                {{ $item->participant }}
            </td>

            <td>
                {{ $item->frequency }}
            </td>

            <td>
                {{ $item->year }}
            </td>

            <td>
                {{ $item->notes }}
            </td>
            
            <td>

                <a href="/admin/annual-work-plans/{{ $item->id }}/schedules"
                class="btn btn-info btn-sm">

                    Schedule

                </a>

            </td>

        </tr>

        @endforeach

    </tbody>

</table>

@stop
@include('partials.logout-script')