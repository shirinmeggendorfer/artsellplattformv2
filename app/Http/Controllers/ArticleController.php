<?php

// App\Http\Controllers\ArticleController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item; 
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;



class ArticleController extends Controller
{
    public function createItem()
    {
        return view('items.createItem');
    }

    public function show(Item $item)
    {
        return view('items.show', compact('item'));
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
            $filenameToStore = $filename . '_' . time() . '.' . $extension; // Behalten Sie die Originalerweiterung
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

        return redirect()->route('startPage')->with('success', 'Artikel erfolgreich erstellt.');
    }

    
    

    public function index(Request $request)
    {
        if ($request->has('search') && $request->search != '') {
            $items = Item::where('title', 'like', '%' . $request->search . '%')->latest()->limit(20)->get();
        } else {
            $items = Item::latest()->limit(20)->get();
        }

        return view('startPage', compact('items'));
    }

    public function update(Request $request, Item $item)
    {
        // Validierung des Bildes
        $request->validate([
            'photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Erweiterungen und maximale Dateigröße anpassen
        ]);

        // Speichern des neuen Bildes
        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $filenameWithExt = $image->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $image->getClientOriginalExtension();
            $filenameToStore = $filename . '_' . time() . '.' . $extension;
            $path = $image->storeAs('public/photos', $filenameToStore);
        } else {
            $filenameToStore = $item->photo;
        }

        // Löschen des alten Bildes, wenn es vorhanden ist
        if ($item->photo && $item->photo != 'noimage.jpg') {
            Storage::delete('public/photos/' . $item->photo);
        }

        // Aktualisieren des Bildpfads in der Datenbank
        $item->photo = $filenameToStore;

        // Aktualisieren der anderen Daten des Artikels
        $item->update([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return redirect()->route('items.show', $item->id)->with('success', 'Artikel erfolgreich aktualisiert.');
    }
    
public function edit(Item $item)
{
    return view('items.edit', compact('item'));
}

}
