<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => [
                'required',
                'email',
                function($attribute, $value, $fail) {
                    $allowedDomains = ['beispiel.de', 'anderesbeispiel.de'];
                    $domain = substr(strrchr($value, "@"), 1); // Extrahiert den Domänenteil der E-Mail-Adresse
                    if (!in_array($domain, $allowedDomains)) {
                        $fail($attribute.' muss eine E-Mail-Adresse von '.implode(' oder ', $allowedDomains).' sein.');
                    }
                },
            ],
            'password' => 'required',
        ]);
    
       
    }

}
