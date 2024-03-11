<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    // Zeigt das Registrierungsformular
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    // Verarbeitet die Registrierung
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Nach der Registrierung kann der Benutzer automatisch eingeloggt werden
        // auth()->login($user);

        return redirect()->route('startPage'); // oder eine andere Route
    }
}