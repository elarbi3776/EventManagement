<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
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
     /**
     * Update the user's avatar.
     */
    public function updateAvatar(Request $request): RedirectResponse
{
    $request->validate([
        'avatar' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
    ]);

    $user = $request->user();
    if ($request->hasFile('avatar')) {
        // Delete old avatar if exists
        if ($user->avatar) {
            Storage::disk('public')->delete(config('chatify.user_avatar.folder') . '/' . $user->avatar);
        }
        // Store new avatar
        $path = $request->file('avatar')->store(config('chatify.user_avatar.folder'), 'public');
        // Update user avatar path
        $user->avatar = basename($path); // Store only the filename
        $user->save();
    }

    return redirect()->back()->with('status', 'avatar-updated');
}

}
