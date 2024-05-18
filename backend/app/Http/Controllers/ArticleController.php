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
    


 
    public function update(Request $request, Item $item)
{
    $request->validate([
        'photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    if ($request->hasFile('photo')) {
        $image = $request->file('photo');
        $filenameWithExt = $image->getClientOriginalName();
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        $extension = $image->getClientOriginalExtension();
        $filenameToStore = $filename . '_' . time() . '.' . $extension;
        $path = $image->storeAs('public/photos', $filenameToStore);

        // Löschen des alten Bildes, falls vorhanden
        if ($item->photo && $item->photo != 'noimage.jpg') {
            Storage::delete('public/photos/' . $item->photo);
        }

        $item->photo = $filenameToStore;
    }

    $item->update([
        'title' => $request->title,
        'description' => $request->description,
    ]);

    return response()->json(['message' => 'Artikel erfolgreich aktualisiert.', 'item' => $item]);
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
