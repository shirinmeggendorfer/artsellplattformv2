<?php

namespace App\Http\Controllers;
use App\Models\Item; 
use Illuminate\Http\Request;

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
    $validated = $request->validate([
        'title' => 'required|max:255',
        'description' => 'required',
        'price' => 'required|numeric',
        'photo' => 'image|nullable',
    ]);

    if ($request->hasFile('photo')) {
        $image = $request->file('photo');
        $filenameWithExt = $image->getClientOriginalName();
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        $extension = $image->getClientOriginalExtension();
        $filenameToStore = $filename . '_' . time() . '.' . $extension;
        $path = $image->storeAs('public/photos', $filenameToStore);

        if ($item->photo && $item->photo != 'noimage.jpg') {
            Storage::delete('public/photos/' . $item->photo);
        }

        $item->photo = $filenameToStore;
    }

    $item->update($validated);

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
        return response()->json(['error' => 'Fehler beim Löschen des Artikels: ' . $e->getMessage()], 500);
    }
}


}
