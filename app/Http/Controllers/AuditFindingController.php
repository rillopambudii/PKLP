<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AuditFinding;
use App\Models\InternalAudit;

class AuditFindingController extends Controller
{
    public function index()
    {
        $data = AuditFinding::with('audit.location')->get();

        return view(
            'admin.audit-findings.index',
            compact('data')
        );
    }

    public function create()
    {
        $audits = InternalAudit::with('location')->get();

        return view(
            'admin.audit-findings.create',
            compact('audits')
        );
    }

    public function store(Request $request)
    {
        AuditFinding::create($request->all());

        return redirect('/admin/audit-findings')
            ->with('success', 'Temuan audit berhasil ditambah');
    }
}