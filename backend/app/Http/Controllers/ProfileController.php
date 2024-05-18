<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use App\Models\Item;


class ProfileController extends Controller
{
    // Artikel löschen
    public function destroyItem(Item $item)
    {
        $item->delete();
        return response()->json(['success' => 'Artikel erfolgreich gelöscht.']);
    }

    public function edit()
    {
        $user = auth()->user();
    
        if (!$user) {
            return response()->json(['error' => 'Unauthenticated'], 401);
        }
    
        $items = $user->items()->get(); // Items des Benutzers laden
    
        return response()->json(['user' => $user, 'items' => $items]);
    }
    

    public function updatePicture(Request $request)
    {
        $request->validate([
            'profile_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Maximale Dateigröße in Kilobyte
        ]);

        if ($request->hasFile('profile_image')) {
            $image = $request->file('profile_image');

            try {
                $filename = auth()->user()->name . '-profileimage-' . now()->format('YmdHis') . '.' . $image->getClientOriginalExtension();
                $path = $image->storeAs('profilepictures', $filename, 'public'); // Bild im Ordner "profilepictures" im öffentlichen Storage speichern

                // Speichern Sie den Bildpfad in der Datenbank
                $user = auth()->user();
                $user->profile_image = 'storage/' . $path;
                $user->save();

                return response()->json(['success' => 'Profilbild erfolgreich aktualisiert.', 'profile_image' => $user->profile_image]);
            } catch (\Exception $e) {
                return response()->json(['error' => 'Fehler beim Speichern des Bildes.'], 500);
            }
        }

        return response()->json(['error' => 'Es wurde kein Bild ausgewählt.'], 400);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request)
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return response()->json(['status' => 'profile-updated']);
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request)
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return response()->json(['message' => 'Account erfolgreich gelöscht.']);
    }
}