<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $carriers = \App\Models\Carrier::latest()->get();
        $contacts = \App\Models\ContactSubmission::latest()->get();

        return view('admin.dashboard', compact('carriers', 'contacts'));
    }
}
