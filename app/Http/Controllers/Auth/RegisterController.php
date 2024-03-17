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
    }

    public function register(Request $request)
    {
        $request->validate([
            // Validierung, dass der Name erforderlich ist, nur Buchstaben enthält und maximal 255 Zeichen lang ist
            'name' => 'required|string|max:255|regex:/^[a-zA-Z\s]+$/',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:users',
                // Benutzerdefinierte Validierung für die E-Mail-Domain
                function ($attribute, $value, $fail) {
                    $allowedDomains = ['gmail.com',
                    'yahoo.com',
                    'icloud.com',
                    'hotmail.com',
                    'aol.com',
                    'hotmail.co.uk',
                    'hotmail.fr',
                    'msn.com',
                    'yahoo.fr',
                    'wanadoo.fr',
                    'orange.fr',
                    'comcast.net',
                    'yahoo.co.uk',
                    'yahoo.com.br',
                    'yahoo.co.in',
                    'live.com',
                    'rediffmail.com',
                    'free.fr',
                    'gmx.de',
                    'web.de',
                    'yandex.ru',
                    'ymail.com',
                    'libero.it',
                    'outlook.com',
                    'uol.com.br',
                    'bol.com.br',
                    'mail.ru',
                    'cox.net',
                    'hotmail.it',
                    'sbcglobal.net',
                    'sfr.fr',
                    'live.fr',
                    'verizon.net',
                    'live.co.uk',
                    'googlemail.com',
                    'yahoo.es',
                    'ig.com.br',
                    'live.nl',
                    'bigpond.com',
                    'terra.com.br',
                    'yahoo.it',
                    'neuf.fr',
                    'yahoo.de',
                    'alice.it',
                    'rocketmail.com',
                    'att.net',
                    'laposte.net',
                    'facebook.com',
                    'bellsouth.net',
                    'yahoo.in',
                    'hotmail.es',
                    'charter.net',
                    'yahoo.ca',
                    'yahoo.com.au',
                    'rambler.ru',
                    'hotmail.de',
                    'tiscali.it',
                    'shaw.ca',
                    'yahoo.co.jp',
                    'sky.com',
                    'earthlink.net',
                    'optonline.net',
                    'freenet.de',
                    't-online.de',
                    'aliceadsl.fr',
                    'virgilio.it',
                    'home.nl',
                    'qq.com',
                    'telenet.be',
                    'me.com',
                    'yahoo.com.ar',
                    'tiscali.co.uk',
                    'yahoo.com.mx',
                    'voila.fr',
                    'gmx.net',
                    'mail.com',
                    'planet.nl',
                    'tin.it',
                    'live.it',
                    'ntlworld.com',
                    'arcor.de',
                    'yahoo.co.id',
                    'frontiernet.net',
                    'hetnet.nl',
                    'live.com.au',
                    'yahoo.com.sg',
                    'zonnet.nl',
                    'club-internet.fr',
                    'juno.com',
                    'optusnet.com.au',
                    'blueyonder.co.uk',
                    'bluewin.ch',
                    'skynet.be',
                    'sympatico.ca',
                    'windstream.net',
                    'mac.com',
                    'centurytel.net',
                    'chello.nl',
                    'live.ca',
                    'aim.com',
                    'bigpond.net.au']; // Erlaubte Domains hier einfügen
                    $domain = substr(strrchr($value, "@"), 1);
                    if (!in_array($domain, $allowedDomains)) {
                        $fail('Die E-Mail-Domain muss eine der folgenden sein: ' . implode(', ', $allowedDomains) . '.');
                    }
                },
            ],
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Nach der Registrierung kann der Benutzer automatisch eingeloggt werden
         auth()->login($user);

        return redirect()->route('startPage'); 
    }
}