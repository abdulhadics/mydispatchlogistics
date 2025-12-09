<?php

namespace App\Http\Controllers;

use App\Models\Rule;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RuleController extends Controller
{
    public function index()
    {
        $rules = Rule::with('creator')->latest()->paginate(15);
        return view('admin.rules', compact('rules'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'type' => 'required|in:safety,compliance,operational,financial',
            'severity' => 'required|in:low,medium,high,critical',
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        $validated['is_active'] = true;
        $validated['created_by'] = auth()->id();

        $rule = Rule::create($validated);

        Notification::createNotification(
            auth()->id(),
            'Rule Created',
            "Rule '{$rule->name}' has been created and is now active.",
            'success',
            'fa-gavel'
        );

        return redirect()->route('admin.rules')
            ->with('success', 'Rule created successfully!');
    }

    public function destroy(Rule $rule)
    {
        $name = $rule->name;
        $rule->delete();

        Notification::createNotification(
            auth()->id(),
            'Rule Deleted',
            "Rule '{$name}' has been deleted.",
            'warning',
            'fa-trash'
        );

        return redirect()->route('admin.rules')
            ->with('success', 'Rule deleted successfully!');
    }
}
