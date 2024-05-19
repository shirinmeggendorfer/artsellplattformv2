<?php

namespace App\Http\Controllers;
use App\Models\Item; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;


class ArticleController extends Controller
{
    
    public function index(Request $request)
    {
        if ($request->has('search') && $request->search != '') {
            $items = Item::where('title', 'like', '%' . $request->search . '%')->latest()->get();
        } else {
            $items = Item::latest()->get();
        }

        return response()->json($items);
    }


public function show(Item $item)
{
    $item->load('user'); 
    return response()->json($item);
}



    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'price' => 'required|numeric',
            'photo' => 'required|image',
        ]);
    
        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $filenameWithExt = $image->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $image->getClientOriginalExtension();
            $filenameToStore = $filename . '_' . time() . '.' . $extension;
            $path = $image->storeAs('public/photos', $filenameToStore);
        } else {
            $filenameToStore = 'noimage.jpg';
        }
    
        $item = new Item();
        $item->title = $validated['title'];
        $item->description = $validated['description'];
        $item->price = $validated['price'];
        $item->photo = $filenameToStore;
        $item->user_id = auth()->id();
        $item->save();
    
        return response()->json(['message' => 'Artikel erfolgreich erstellt.', 'item' => $item], 201);
    }
    

    public function userItems()
{
    $user = auth()->user();
    if (!$user) {
        return response()->json(['error' => 'Unauthenticated'], 401);
    }

    $items = $user->items()->get();
    return response()->json($items);
}


public function update(Request $request, Item $item)
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


public function destroy(Item $item)
{
    try {
        // Löschen des Bildes, falls vorhanden
        if ($item->photo && $item->photo != 'noimage.jpg') {
            Storage::delete('public/photos/' . $item->photo);
        }

        $item->delete();

        return response()->json(['message' => 'Artikel erfolgreich gelöscht.']);
    } catch (\Exception $e) {
        // Loggen Sie den Fehler zur weiteren Analyse
        \Log::error('Fehler beim Löschen des Artikels: ', ['error' => $e->getMessage()]);
        return response()->json(['error' => 'Fehler beim Löschen des Artikels: ' . $e->getMessage()], 500);
    }
}




}
