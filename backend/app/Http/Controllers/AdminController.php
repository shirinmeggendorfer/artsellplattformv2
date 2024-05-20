<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Models\Item;

class AdminController extends Controller
{
    public function getUsers()
    {
        $users = User::all();
        return response()->json($users);
    }

    public function getUser(User $user)
    {
        return response()->json($user);
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
            'password' => $request->password ? Hash::make($request->password) : $user->password,
        ]);

        return response()->json(['message' => 'Benutzer erfolgreich aktualisiert.', 'user' => $user]);
    }

    public function getUserItems(User $user)
    {
        $items = $user->items;
        return response()->json($items);
    }

    public function destroyUser(User $user)
    {
        $user->items()->delete();
        $user->delete();

        return response()->json(['message' => 'Benutzer erfolgreich gelöscht.']);
    }

    public function getArticle(Item $item)
    {
        return response()->json($item);
    }

 

    public function updateArticle(Request $request, Item $item)
    {
        Log::info('Update request received for item ID: ' . $item->id);
    
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'price' => 'required|numeric',
            'photo' => 'image|nullable|max:2048', // Set a max size for image upload
        ]);
    
        Log::info('Validation passed');
    
        if ($request->hasFile('photo')) {
            Log::info('Photo upload detected');
            
            $image = $request->file('photo');
            $filename = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $image->getClientOriginalExtension();
            $filenameToStore = $filename . '_' . time() . '.' . $extension;
            
            // Store the image in the 'public/photos' directory
            $path = $image->storeAs('public/photos', $filenameToStore);
    
            Log::info('Photo stored at: ' . $path);
    
            // Delete the old photo if it exists and is not the default one
            if ($item->photo && $item->photo != 'noimage.jpg') {
                Storage::delete('public/photos/' . $item->photo);
                Log::info('Previous photo deleted: ' . $item->photo);
            }
    
            $item->photo = $filenameToStore;
        }
    
        // Update the item with the validated data
        $item->title = $validated['title'];
        $item->description = $validated['description'];
        $item->price = $validated['price'];
    
        // Save the updated item
        $item->save();
    
        Log::info('Item updated: ', $item->toArray());
    
        return response()->json(['message' => 'Artikel erfolgreich aktualisiert.', 'item' => $item]);
    }





    public function destroyArticle(Item $item)
    {
        $item->delete();
        return response()->json(['message' => 'Artikel erfolgreich gelöscht.']);
    }

    public function searchUser(Request $request)
    {
        $searchTerm = $request->input('search');
        $users = User::query()
            ->where('name', 'LIKE', "%{$searchTerm}%")
            ->orWhere('email', 'LIKE', "%{$searchTerm}%")
            ->get();

        return response()->json($users);
    }
}
