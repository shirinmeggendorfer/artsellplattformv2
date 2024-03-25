<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Item;


class AdminController extends Controller
{
    public function dashboard()
    {
        $users = User::all(); // Alle Benutzer holen
        return view('admin.dashboard', compact('users'));
    }

    public function editUser(User $user)
    {
        
        return view('admin.editUser', compact('user'));
    }
    
    public function updateUser(Request $request, User $user)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255',
        'password' => 'sometimes|nullable|string|min:8',
    ]);

    $user->update([
        'name' => $request->name,
        'email' => $request->email,
        // Aktualisieren Sie das Passwort nur, wenn eines eingegeben wurde
        'password' => $request->password ? Hash::make($request->password) : $user->password,
    ]);

    return redirect()->route('admin.dashboard')->with('success', 'Benutzer erfolgreich aktualisiert.');
}

// Benutzer löschen
public function destroyUser(User $user)
{
    $user->delete();
    return redirect()->route('admin.dashboard')->with('success', 'Benutzer erfolgreich gelöscht.');
}

        // Artikel eines Benutzers zur Bearbeitung anzeigen
        public function editArticle(Item $item)
        {
            return view('admin.editArticle', compact('item'));
        }
        

    // Artikel aktualisieren
    public function updateArticle(Request $request, Item $item)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
         
        ]);

        $item->update($request->all());

        return back()->with('success', 'Artikel erfolgreich aktualisiert.');
    }
    public function destroyArticle(Item $item)
    {
        $item->delete();
        return redirect()->route('admin.dashboard')->with('success', 'Artikel erfolgreich gelöscht.');
    }
    
    public function searchUser(Request $request)
    {
        $searchTerm = $request->input('search');
        $users = User::query()
                    ->where('name', 'LIKE', "%{$searchTerm}%")
                    ->orWhere('email', 'LIKE', "%{$searchTerm}%")
                    ->get();
    
        return view('admin.dashboard', compact('users'));
    }

}

