<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class SettingsController extends Controller
{
    /**
     * Display the admin settings page.
     */
    public function index(): View
    {
        $user = Auth::guard('admin')->user() ?? Auth::user();

        return view('admin.settings.index', [
            'user' => $user,
        ]);
    }
}
