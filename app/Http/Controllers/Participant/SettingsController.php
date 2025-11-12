<?php

namespace App\Http\Controllers\Participant;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class SettingsController extends Controller
{
    /**
     * Display the participant settings page.
     */
    public function index(): View
    {
        $user = Auth::guard('participant')->user() ?? Auth::user();

        return view('participant.settings.index', [
            'user' => $user,
        ]);
    }
}
