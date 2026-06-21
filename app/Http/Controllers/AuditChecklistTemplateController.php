<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AuditChecklistTemplate;

class AuditChecklistTemplateController extends Controller
{
    public function index()
    {
        $data = AuditChecklistTemplate::all();

        return view(
            'admin.audit-checklist-templates.index',
            compact('data')
        );
    }

    public function create()
    {
        return view('admin.audit-checklist-templates.create');
    }

    public function store(Request $request)
    {
        AuditChecklistTemplate::create($request->all());

        return redirect('/admin/audit-checklist-templates')
            ->with('success', 'Template checklist berhasil ditambah');
    }
}