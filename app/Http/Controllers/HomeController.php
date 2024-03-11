<?php

namespace App\Http\Controllers;

use App\Models\Item; // Stellen Sie sicher, dass Sie das Model verwenden
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $items = Item::latest()->take(10)->get();
        return view('startPage', compact('items'));

    }


    public function startPage(Request $request)
    {
        $searchQuery = $request->input('search');
    
        if (!empty($searchQuery)) {
            // Artikel basierend auf der Suchanfrage filtern
            $items = Item::where('title', 'like', '%' . $searchQuery . '%')
                         ->latest()
                         ->get();
            $title = null; // Titel ausblenden, wenn Suchergebnisse angezeigt werden
        } else {
            // Die letzten 20 hochgeladenen Artikel anzeigen, wenn keine Suchanfrage vorliegt
            $items = Item::latest()
                         ->take(20)
                         ->get();
            $title = 'Last uploads'; // Standardtitel anzeigen
        }
    
        return view('startPage', compact('items', 'title'));
    }
}