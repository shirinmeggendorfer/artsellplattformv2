<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;


    class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    


        // Nach der Registrierung kann der Benutzer automatisch eingeloggt werden
         auth()->login($user);

        return redirect()->route('startPage'); 
    
    }
}