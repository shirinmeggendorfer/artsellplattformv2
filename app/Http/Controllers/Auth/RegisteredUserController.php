<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255','regex:/^[a-zA-ZäöüÄÖÜ\s]+$/'],
            'surname' => ['required', 'string', 'max:255','regex:/^[a-zA-ZäöüÄÖÜ\s]+$/'],
            'email' =>[
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                'unique:'.User::class,
                // Benutzerdefinierte Validierung für die E-Mail-Domain
                function ($attribute, $value, $fail) {
                    $allowedDomains = ['.de', 'net', '.com', '.it', 'fr', 'org', 'esp']; // Erlaubte Domains hier einfügen
                    $atIndex = strrpos($value, '@');
                    if ($atIndex !== false) {
                        $domain = substr($value, $atIndex + 1);
                        if (!in_array($domain, $allowedDomains)) {
                            $fail('Die E-Mail-Domain muss eine der folgenden sein: ' . implode(', ', $allowedDomains) . '.');
                        }
                    } else {
                        $fail('Die E-Mail muss ein "@"-Symbol enthalten.');
                    }
                },
            ],
            
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
