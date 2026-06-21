<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ManagementReview;

class ManagementReviewController extends Controller
{
    public function index()
    {
        $data = ManagementReview::all();

        return view(
            'admin.management-reviews.index',
            compact('data')
        );
    }

    public function create()
    {
        return view(
            'admin.management-reviews.create'
        );
    }

    public function store(Request $request)
    {
        ManagementReview::create(
            $request->all()
        );

        return redirect('/admin/management-reviews')
            ->with('success', 'Data berhasil ditambah');
    }
}