<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Item;


class ProfileController extends Controller
{
    // Artikel löschen
public function destroyItem(Item $item)
{
    $item->delete();
    return redirect()->back()->with('success', 'Artikel erfolgreich gelöscht.');
}

    public function edit()
    {
        $user = auth()->user();
        $items = $user->items()->get(); // Items des Benutzers laden
    
        return view('profile.edit', compact('user', 'items'));
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
                $user->profile_image = 'profilepictures/'.$filename;
                $user->save();
    
                return redirect()->back()->with('success', 'Profilbild erfolgreich aktualisiert.');
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'Fehler beim Speichern des Bildes.');
            }
        }
    
        return redirect()->back()->with('error', 'Es wurde kein Bild ausgewählt.');
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
