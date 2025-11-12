<?php

namespace App\Http\Controllers\Participant;

use App\Http\Controllers\Controller;
use App\Http\Requests\Participant\ChangePasswordRequest;
use App\Http\Requests\Participant\UpdateProfileRequest;
use App\Models\Participante;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Get the current participant for the authenticated user.
     */
    private function getParticipante(): Participante
    {
        $user = Auth::guard('participant')->user() ?? Auth::user();

        $participante = Participante::with([
            'persona',
            'institucionProyecto.institucion',
            'institucionProyecto.proyecto',
        ])
            ->where('persona_id', $user->persona_id)
            ->latest()
            ->first();

        if (! $participante) {
            abort(404, 'No se encontró información de participante para tu cuenta.');
        }

        return $participante;
    }

    /**
     * Display the participant profile page.
     */
    public function index(): View
    {
        $user = Auth::guard('participant')->user() ?? Auth::user();
        $participante = $this->getParticipante();

        // Obtener historial de participación en proyectos
        $historialProyectos = Participante::with([
            'institucionProyecto.institucion',
            'institucionProyecto.proyecto',
        ])
            ->where('persona_id', $user->persona_id)
            ->orderByDesc('created_at')
            ->get();

        return view('participant.profile.index', [
            'participante' => $participante,
            'user' => $user,
            'historialProyectos' => $historialProyectos,
        ]);
    }

    /**
     * Update the participant profile.
     */
    public function update(UpdateProfileRequest $request): RedirectResponse
    {
        $user = Auth::guard('participant')->user() ?? Auth::user();

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

        return redirect()->route('participant.profile.index')
            ->with('success', 'Perfil actualizado exitosamente.');
    }

    /**
     * Change the participant password.
     */
    public function changePassword(ChangePasswordRequest $request): RedirectResponse
    {
        $user = Auth::guard('participant')->user() ?? Auth::user();

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('participant.profile.index')
            ->with('success', 'Contraseña actualizada exitosamente.');
    }
}
