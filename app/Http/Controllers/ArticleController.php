<?php

// App\Http\Controllers\ArticleController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item; 
use Intervention\Image\Facades\Image;

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
            $filenameWithExt = $request->file('photo')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('photo')->getClientOriginalExtension();
            $filenameToStore = $filename.'_'.time().'.'.$extension;
            $path = $request->file('photo')->storeAs('public/photos', $filenameToStore);
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
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
        ]);

        $item->update($request->all());

        return redirect()->route('items.show', $item->id)->with('success', 'Artikel erfolgreich aktualisiert.');
    }

    public function destroy(Item $item)
    {
        $item->delete();
        return redirect()->route('startPage')->with('success', 'Artikel erfolgreich gelöscht.');
    }

    public function edit(Item $item)
    {
        
        return view('items.edit', compact('item'));
    }
}