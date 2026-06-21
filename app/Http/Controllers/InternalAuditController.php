<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InternalAudit;
use App\Models\MasterLocation;
use App\Models\AuditChecklistTemplate;
use App\Models\AuditChecklistAnswer;
use Barryvdh\DomPDF\Facade\Pdf;

class InternalAuditController extends Controller
{
    public function index()
    {
        $data = InternalAudit::with('location')->get();

        return view(
            'admin.internal-audits.index',
            compact('data')
        );
    }

    public function create()
    {
        $locations = MasterLocation::all();

        return view(
            'admin.internal-audits.create',
            compact('locations')
        );
    }

    public function store(Request $request)
    {
        InternalAudit::create(
            $request->all()
        );

        return redirect('/admin/internal-audits')
            ->with('success', 'Audit berhasil ditambah');
    }
    
    public function checklist($id)
    {
        $audit = InternalAudit::with('location')->findOrFail($id);

        $templates = AuditChecklistTemplate::where('audit_type', $audit->audit_type)
            ->when($audit->audit_type == 'Office', function ($query) use ($audit) {
                return $query->where('department', $audit->department);
            })
            ->get();

        return view(
            'admin.internal-audits.checklist',
            compact('audit', 'templates')
        );
    }

    public function storeChecklist(Request $request, $id)
    {
        foreach ($request->answers as $templateId => $answer) {
            AuditChecklistAnswer::updateOrCreate(
                [
                    'internal_audit_id' => $id,
                    'audit_checklist_template_id' => $templateId,
                ],
                [
                    'answer' => $answer,
                    'finding_type' => $request->finding_types[$templateId] ?? null,
                    'notes' => $request->notes[$templateId] ?? null,
                ]
            );
        }

        return back()->with('success', 'Checklist berhasil disimpan');
    }

    public function exportPdf($id)
    {
        $audit = InternalAudit::with([
            'location',
            'checklistAnswers.template',
            'findings',
        ])->findOrFail($id);

        $pdf = Pdf::loadView(
            'admin.internal-audits.export-pdf',
            compact('audit')
        )->setPaper('a4', 'portrait');

        return $pdf->download(
            'internal-audit-' . $audit->id . '.pdf'
        );
    }
}