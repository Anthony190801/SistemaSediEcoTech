<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ChangePasswordRequest;
use App\Http\Requests\Admin\UpdateProfileRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the admin profile page.
     */
    public function index(): View
    {
        $user = Auth::guard('admin')->user() ?? Auth::user();

        return view('admin.profile.index', [
            'user' => $user,
        ]);
    }

    /**
     * Update the admin profile.
     */
    public function update(UpdateProfileRequest $request): RedirectResponse
    {
        $user = Auth::guard('admin')->user() ?? Auth::user();

        $data = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        // Handle profile picture upload
        if ($request->hasFile('profile_picture')) {
            // Delete old profile picture if exists
            if ($user->profile_picture) {
                Storage::disk('public')->delete($user->profile_picture);
            }

            // Store new profile picture
            $path = $request->file('profile_picture')->store('profile-pictures', 'public');
            $data['profile_picture'] = $path;
        }

        $user->update($data);

        return redirect()->route('admin.profile.index')
            ->with('success', 'Perfil actualizado exitosamente.');
    }

    /**
     * Change the admin password.
     */
    public function changePassword(ChangePasswordRequest $request): RedirectResponse
    {
        $user = Auth::guard('admin')->user() ?? Auth::user();

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.profile.index')
            ->with('success', 'Contraseña actualizada exitosamente.');
    }
}
