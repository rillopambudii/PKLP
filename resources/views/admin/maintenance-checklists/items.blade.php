@extends('layouts.admin')

@section('title', 'Maintenance Items')

@section('content_header')
    <h1>Maintenance Items</h1>
@stop

@section('content')

<div class="card mb-3">
    <div class="card-body">
        <strong>Tipe:</strong> {{ $checklist->maintenance_type }} <br>
        <strong>Kapal:</strong> {{ $checklist->location->name ?? '-' }} <br>
        <strong>Periode:</strong> {{ $checklist->month }} {{ $checklist->year }}
    </div>
</div>

<div class="card mb-4">
    <div class="card-header">
        <h3 class="card-title">Tambah Item Maintenance</h3>
    </div>

    <div class="card-body">
        <form method="POST" action="/admin/maintenance-checklists/{{ $checklist->id }}/items">
            @csrf

            <div class="form-group mb-3">
                <label>Equipment</label>
                <input type="text" name="equipment" class="form-control">
            </div>

            <div class="form-group mb-3">
                <label>Item No</label>
                <input type="text" name="item_no" class="form-control">
            </div>

            <div class="form-group mb-3">
                <label>Item Name</label>
                <input type="text" name="item_name" class="form-control">
            </div>

            <div class="form-group mb-3">
                <label>Task Description</label>
                <textarea name="task_description" class="form-control" rows="3"></textarea>
            </div>

            <div class="form-group mb-3">
                <label>Periodical Standard</label>
                <input type="text" name="periodical_standard" class="form-control" placeholder="Daily / Weekly / Monthly">
            </div>

            <div class="form-group mb-3">
                <label>Monitor By</label>
                <input type="text" name="monitor_by" class="form-control">
            </div>

            <div class="form-group mb-3">
                <label>Remarks</label>
                <textarea name="remarks" class="form-control" rows="2"></textarea>
            </div>

            <button class="btn btn-success">Simpan Item</button>
        </form>
    </div>
</div>

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>No</th>
            <th>Equipment</th>
            <th>Item No</th>
            <th>Item Name</th>
            <th>Task</th>
            <th>Standard</th>
            <th>Monitor By</th>
            <th>Remarks</th>
            <th>Daily Check</th>
        </tr>
    </thead>

    <tbody>
        @foreach($items as $item)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $item->equipment }}</td>
            <td>{{ $item->item_no }}</td>
            <td>{{ $item->item_name }}</td>
            <td>{{ $item->task_description }}</td>
            <td>{{ $item->periodical_standard }}</td>
            <td>{{ $item->monitor_by }}</td>
            <td>{{ $item->remarks }}</td>
            <td>
                <form method="POST"
                    action="/admin/maintenance-items/{{ $item->id }}/daily-checks">
                    @csrf

                    <input type="date"
                        name="check_date"
                        class="form-control mb-2"
                        value="{{ date('Y-m-d') }}">

                    <select name="status"
                            class="form-control mb-2">
                        <option>Checked</option>
                        <option>Not Checked</option>
                        <option>Finding</option>
                    </select>

                    <textarea name="note"
                            class="form-control mb-2"
                            rows="2"
                            placeholder="Note"></textarea>

                    <button class="btn btn-success btn-sm">
                        Save
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@stop