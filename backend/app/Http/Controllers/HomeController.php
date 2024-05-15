<?php

namespace App\Http\Controllers;

use App\Models\Item; // Stellen Sie sicher, dass Sie das Model verwenden
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Return the latest 10 items as JSON.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $items = Item::latest()->take(10)->get();
        return response()->json($items);
    }

    /**
     * Return items based on the search query or return the latest 20 items.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function startPage(Request $request)
    {
        $searchQuery = $request->input('search');
    
        if (!empty($searchQuery)) {
            $items = Item::where('title', 'like', '%' . $searchQuery . '%')
                         ->latest()
                         ->get();
            $title = null; // Titel ausblenden, wenn Suchergebnisse angezeigt werden
        } else {
            $items = Item::latest()
                         ->take(20)
                         ->get();
            $title = 'Last uploads'; // Standardtitel anzeigen
        }
    
        // Nun wird ein JSON-Response mit Items und einem optionalen Titel zurückgegeben
        return response()->json([
            'items' => $items,
            'title' => $title
        ]);
    }
}
