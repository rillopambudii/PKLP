<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">

    <style>

        body{
            font-family: sans-serif;
            font-size: 12px;
        }

        table{
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td{
            border: 1px solid black;
        }

        th, td{
            padding: 6px;
            vertical-align: top;
        }

        .text-center{
            text-align: center;
        }

        .mb-20{
            margin-bottom: 20px;
        }

        .signature{
            height: 80px;
        }

    </style>

</head>

<body>

    <h2 class="text-center">
        INTERNAL AUDIT REPORT
    </h2>

    <table class="mb-20">

        <tr>
            <td width="30%">
                Audit Type
            </td>

            <td>
                {{ $audit->audit_type }}
            </td>
        </tr>

        <tr>
            <td>
                Audit Date
            </td>

            <td>
                {{ $audit->audit_date }}
            </td>
        </tr>

        <tr>
            <td>
                Location / Department
            </td>

            <td>
                {{ $audit->location->name ?? $audit->department }}
            </td>
        </tr>

        <tr>
            <td>
                Auditor
            </td>

            <td>
                {{ $audit->auditor }}
            </td>
        </tr>

        <tr>
            <td>
                Auditee
            </td>

            <td>
                {{ $audit->auditee }}
            </td>
        </tr>

    </table>

    <h3>
        Audit Checklist
    </h3>

    <table class="mb-20">

        <thead>

            <tr>

                <th>No</th>

                <th>Section</th>

                <th>Clause</th>

                <th>Question</th>

                <th>Answer</th>

                <th>Finding</th>

                <th>Notes</th>

            </tr>

        </thead>

        <tbody>

            @foreach($audit->checklistAnswers as $item)

            <tr>

                <td>
                    {{ $loop->iteration }}
                </td>

                <td>
                    {{ $item->template->section ?? '-' }}
                </td>

                <td>
                    {{ $item->template->clause ?? '-' }}
                </td>

                <td>
                    {{ $item->template->question ?? '-' }}
                </td>

                <td>
                    {{ $item->answer }}
                </td>

                <td>
                    {{ $item->finding_type }}
                </td>

                <td>
                    {{ $item->notes }}
                </td>

            </tr>

            @endforeach

        </tbody>

    </table>

    <h3>
        Audit Findings
    </h3>

    <table class="mb-20">

        <thead>

            <tr>

                <th>No</th>

                <th>Clause</th>

                <th>Description</th>

                <th>Type</th>

                <th>Corrective Action</th>

                <th>Status</th>

            </tr>

        </thead>

        <tbody>

            @foreach($audit->findings as $item)

            <tr>

                <td>
                    {{ $loop->iteration }}
                </td>

                <td>
                    {{ $item->clause }}
                </td>

                <td>
                    {{ $item->finding_description }}
                </td>

                <td>
                    {{ $item->finding_type }}
                </td>

                <td>
                    {{ $item->corrective_action }}
                </td>

                <td>
                    {{ $item->status }}
                </td>

            </tr>

            @endforeach

        </tbody>

    </table>

    <br><br>

    <table>

        <tr>

            <td class="text-center signature">

                Auditor

                <br><br><br><br>

                {{ $audit->auditor }}

            </td>

            <td class="text-center signature">

                Auditee

                <br><br><br><br>

                {{ $audit->auditee }}

            </td>

        </tr>

    </table>

</body>
</html>