<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use App\Models\User;

class ProfileController extends Controller
{
    public function index()
    {


        /** @var User $user */
        $user = auth()->user();
        return view('user.index', [
            'user' => $user,
        ]);
    }

    public function updatePhoto(Request $request)
    {
        $request->validate([
            'photo' => 'required|image|max:2048',
        ], [
            'photo.required' => 'Por favor, selecione uma imagem para upload.',
            'photo.image' => 'O arquivo deve ser uma imagem válida.',
            'photo.max' => 'A imagem não pode ter mais de 2MB.',
        ]);

        /** @var User $user */
        $user = auth()->user();


        if ($user->path_foto && Storage::disk('public')->exists($user->path_foto)) {
            Storage::disk('public')->delete($user->path_foto);
        }


        $path = $request->file('photo')->store('profile-photos', 'public');

        $updated = $user->update(['path_foto' => $path]);

        if (!$updated) {
            logger('Falha ao atualizar path_foto no banco de dados.');
        }

        return redirect()->route('profile.index')->with('success', 'Sua foto de perfil foi atualizada com sucesso!');
    }
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
