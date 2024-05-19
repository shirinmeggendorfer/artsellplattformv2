<?php

namespace App\Http\Controllers;

use App\Models\Item; // Stellen Sie sicher, dass Sie das Model verwenden
use Illuminate\Http\Request;

class HomeController extends Controller
{
    
    public function index()
    {
        $items = Item::latest()->take(10)->get();
        return response()->json($items);
    }

    
    public function startPage(Request $request)
    {
        $searchQuery = $request->input('search');

        if (!empty($searchQuery)) {
            $items = Item::where('title', 'like', '%' . $searchQuery . '%')
                         ->latest()
                         ->get();
        } else {
            $items = Item::latest()
                         ->take(20)
                         ->get();
        }

        return response()->json($items);
    }
    /*    
    // Nun wird ein JSON-Response mit Items und einem optionalen Titel zurückgegeben
        return response()->json([
            'items' => $items,
            'title' => $title
        ]);
        
    }
    */
}




   
