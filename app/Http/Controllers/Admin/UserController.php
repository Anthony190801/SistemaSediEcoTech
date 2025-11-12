<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreUserRequest;
use App\Http\Requests\Admin\UpdateUserRequest;
use App\Models\Persona;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $query = User::with('persona');

        // Búsqueda por nombre, email o DNI
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhereHas('persona', function ($q) use ($search) {
                        $q->where('dni', 'like', "%{$search}%")
                            ->orWhere('nombres', 'like', "%{$search}%")
                            ->orWhere('apellidos', 'like', "%{$search}%");
                    });
            });
        }

        // Filtro por rol
        if ($request->filled('rol')) {
            $query->where('rol', $request->rol);
        }

        // Filtro por estado
        if ($request->filled('status_user')) {
            $query->where('status_user', $request->status_user);
        }

        $users = $query->latest()->paginate(15);

        return view('admin.users.index', [
            'users' => $users,
            'search' => $request->search,
            'rolFilter' => $request->rol,
            'statusFilter' => $request->status_user,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        // Obtener personas que no tienen usuario asociado
        $personasDisponibles = Persona::whereDoesntHave('users')
            ->orderBy('nombres')
            ->orderBy('apellidos')
            ->get();

        return view('admin.users.create', [
            'personasDisponibles' => $personasDisponibles,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request): RedirectResponse
    {
        DB::beginTransaction();

        try {
            // Si se proporciona persona_id, usar persona existente, sino crear nueva
            if ($request->filled('persona_id')) {
                $persona = Persona::findOrFail($request->persona_id);

                // Verificar que la persona no tenga usuario asociado
                if ($persona->users()->exists()) {
                    DB::rollBack();

                    return back()->withInput()
                        ->with('error', 'La persona seleccionada ya tiene un usuario asociado.');
                }
            } else {
                // Crear la persona nueva
                $persona = Persona::create([
                    'dni' => $request->dni,
                    'nombres' => $request->nombres,
                    'apellidos' => $request->apellidos,
                    'sexo' => $request->sexo,
                ]);
            }

            // Manejar la imagen de perfil si existe
            $profilePicturePath = null;
            if ($request->hasFile('profile_picture')) {
                $profilePicturePath = $request->file('profile_picture')->store('profile-pictures', 'public');
            }

            // Crear el usuario
            User::create([
                'persona_id' => $persona->id,
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'profile_picture' => $profilePicturePath,
                'rol' => $request->rol,
                'status_user' => $request->status_user,
            ]);

            DB::commit();

            return redirect()->route('admin.users.index')
                ->with('success', 'Usuario creado exitosamente.');
        } catch (\Exception $e) {
            DB::rollBack();

            return back()->withInput()
                ->with('error', 'Error al crear el usuario: '.$e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user): View
    {
        $user->load('persona');

        return view('admin.users.show', [
            'user' => $user,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user): View
    {
        $user->load('persona');

        return view('admin.users.edit', [
            'user' => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user): RedirectResponse
    {
        DB::beginTransaction();

        try {
            // Actualizar la persona
            $user->persona->update([
                'dni' => $request->dni,
                'nombres' => $request->nombres,
                'apellidos' => $request->apellidos,
                'sexo' => $request->sexo,
            ]);

            // Manejar la imagen de perfil si existe
            $profilePicturePath = $user->profile_picture;
            if ($request->hasFile('profile_picture')) {
                // Eliminar imagen anterior si existe
                if ($user->profile_picture && Storage::disk('public')->exists($user->profile_picture)) {
                    Storage::disk('public')->delete($user->profile_picture);
                }
                $profilePicturePath = $request->file('profile_picture')->store('profile-pictures', 'public');
            }

            // Actualizar el usuario
            $updateData = [
                'name' => $request->name,
                'email' => $request->email,
                'profile_picture' => $profilePicturePath,
                'rol' => $request->rol,
                'status_user' => $request->status_user,
            ];

            // Actualizar contraseña solo si se proporcionó
            if ($request->filled('password')) {
                $updateData['password'] = Hash::make($request->password);
            }

            $user->update($updateData);

            DB::commit();

            return redirect()->route('admin.users.index')
                ->with('success', 'Usuario actualizado exitosamente.');
        } catch (\Exception $e) {
            DB::rollBack();

            return back()->withInput()
                ->with('error', 'Error al actualizar el usuario: '.$e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user): RedirectResponse
    {
        try {
            DB::beginTransaction();

            // Guardar referencia a la persona antes de eliminar el usuario
            $persona = $user->persona;

            // Eliminar imagen de perfil si existe
            if ($user->profile_picture && Storage::disk('public')->exists($user->profile_picture)) {
                Storage::disk('public')->delete($user->profile_picture);
            }

            // Eliminar usuario
            $user->delete();

            // Si la persona no tiene participantes ni otros usuarios, eliminarla también
            if ($persona && $persona->participantes()->count() === 0 && $persona->users()->count() === 0) {
                $persona->delete();
            }

            DB::commit();

            return redirect()->route('admin.users.index')
                ->with('success', 'Usuario eliminado exitosamente.');
        } catch (\Exception $e) {
            DB::rollBack();

            return back()->with('error', 'Error al eliminar el usuario: '.$e->getMessage());
        }
    }
}
