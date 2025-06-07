<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $listings = $user->listings()
            ->latest()
            ->paginate(10);

        return view('dashboard', compact('listings'));
    }
}
