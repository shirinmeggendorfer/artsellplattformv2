<?php

// App\Http\Controllers\ArticleController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item; 
class ArticleController extends Controller
{
    
        public function createItem()
        {
            return view('items.createItem');
        }
    
    
    public function show(Item $item)
{
    // Stellen Sie sicher, dass das Item-Model eine Beziehung zum User-Model hat
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

        $path = $request->file('photo')->store('public/photos');

        $article = new Item();
        $article->title = $validated['title'];
        $article->description = $validated['description'];
        $article->price = $validated['price'];
        $article->photo = $path;
        $article->user_id = auth()->id(); // Stellen Sie sicher, dass Artikel Benutzern zugeordnet sind
        $article->save();

        return redirect()->route('startPage')->with('success', 'Artikel erfolgreich erstellt.');
    }

    public function index(Request $request)
{
    if ($request->has('search') && $request->search != '') {
        $items = Item::where('title', 'like', '%' . $request->search . '%')
            ->latest()
            ->limit(20)
            ->get();
    } else {
        $items = Item::latest()->limit(20)->get();
    }

    return view('startPage', compact('items'));
}


}
