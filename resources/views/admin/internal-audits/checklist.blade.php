@extends('layouts.admin')

@section('title', 'Audit Checklist')

@section('content_header')
    <h1>
        Audit Checklist -
        {{ $audit->audit_type }}
    </h1>
@stop

@section('content')

<div class="card mb-3">
    <div class="card-body">

        <strong>Tanggal Audit:</strong>
        {{ $audit->audit_date }}

        <br>

        <strong>Lokasi / Department:</strong>

        {{ $audit->location->name ?? $audit->department ?? '-' }}

    </div>
</div>

<form method="POST"
      action="/admin/internal-audits/{{ $audit->id }}/checklist">

    @csrf

    <table class="table table-bordered table-striped">

        <thead>
            <tr>
                <th>No</th>
                <th>Section</th>
                <th>Klausul</th>
                <th>Pertanyaan</th>
                <th>Jawaban</th>
                <th>Temuan</th>
                <th>Catatan</th>
            </tr>
        </thead>

        <tbody>

            @foreach($templates as $item)

            <tr>

                <td>{{ $loop->iteration }}</td>

                <td>
                    {{ $item->section }}
                </td>

                <td>
                    {{ $item->clause }}
                </td>

                <td>
                    {{ $item->question }}
                </td>

                <td width="150">

                    <select name="answers[{{ $item->id }}]"
                            class="form-control">

                        <option value="">- Pilih -</option>

                        <option value="Ya">
                            Ya
                        </option>

                        <option value="Tidak">
                            Tidak
                        </option>

                        <option value="N/A">
                            N/A
                        </option>

                    </select>

                </td>

                <td width="150">

                    <select name="finding_types[{{ $item->id }}]"
                            class="form-control">

                        <option value="">-</option>

                        <option value="OFI">
                            OFI
                        </option>

                        <option value="Obs">
                            Obs
                        </option>

                        <option value="Minor">
                            Minor
                        </option>

                        <option value="Major">
                            Major
                        </option>

                    </select>

                </td>

                <td>

                    <textarea
                        name="notes[{{ $item->id }}]"
                        class="form-control"
                        rows="2"></textarea>

                </td>

            </tr>

            @endforeach

        </tbody>

    </table>

    <button class="btn btn-success">

        Simpan Checklist

    </button>

</form>

@stop