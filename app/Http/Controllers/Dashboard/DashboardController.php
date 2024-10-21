<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $userData = Auth::guard('web')->user();
       
        return view('pages.dashboard.index', [
            'title' => 'Admin Dashboard | Dashboard',
            'breadcrumbs' => [
                'Dashboard' => route('dashboard')
            ],
            'user' => $userData
        ]);
    }
}
