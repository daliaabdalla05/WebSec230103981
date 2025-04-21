<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\RefundPolicy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RefundPolicyController extends Controller
{
    public function index()
    {
        $policies = RefundPolicy::active()->orderBy('created_at', 'desc')->get();
        return view('refund-policies.index', compact('policies'));
    }

    public function show(RefundPolicy $policy)
    {
        return view('refund-policies.show', compact('policy'));
    }

    public function create()
    {
        abort_unless(Auth::user()->hasRole('Admin') || Auth::user()->hasRole('Employee'), 403);
        return view('refund-policies.create');
    }

    public function store(Request $request)
    {
        abort_unless(Auth::user()->hasRole('Admin') || Auth::user()->hasRole('Employee'), 403);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'is_active' => 'boolean',
            'effective_from' => 'nullable|date',
            'effective_until' => 'nullable|date|after:effective_from',
        ]);

        RefundPolicy::create($validated);

        return redirect()->route('refund-policies.index')
            ->with('success', 'Refund policy created successfully.');
    }

    public function edit(RefundPolicy $policy)
    {
        abort_unless(Auth::user()->hasRole('Admin') || Auth::user()->hasRole('Employee'), 403);
        return view('refund-policies.edit', compact('policy'));
    }

    public function update(Request $request, RefundPolicy $policy)
    {
        abort_unless(Auth::user()->hasRole('Admin') || Auth::user()->hasRole('Employee'), 403);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'is_active' => 'boolean',
            'effective_from' => 'nullable|date',
            'effective_until' => 'nullable|date|after:effective_from',
        ]);

        $policy->update($validated);

        return redirect()->route('refund-policies.index')
            ->with('success', 'Refund policy updated successfully.');
    }

    public function destroy(RefundPolicy $policy)
    {
        abort_unless(Auth::user()->hasRole('Admin') || Auth::user()->hasRole('Employee'), 403);

        $policy->delete();

        return redirect()->route('refund-policies.index')
            ->with('success', 'Refund policy deleted successfully.');
    }
} 