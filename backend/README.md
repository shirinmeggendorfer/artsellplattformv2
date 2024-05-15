<<<<<<< HEAD
<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

Setup:
    Vorraussetzung: 
        - PHP
        - Composer
        - Laravel
        - mySQL

    Anleitung: 
        Mac
        1. Installieren von Homebrew
                Homebrew ist ein Paketmanager für macOS, der die Installation         von Software erleichtert. Öffnen Sie das Terminal und führen Sie folgenden Befehl aus, um Homebrew zu installieren:
                /bin/bash -c "$(curl -fsSL https://raw.githubusercontent.com/Homebrew/install/HEAD/install.sh)"
        
        2. Installieren von PHP
                Laravel benötigt PHP. Sie können PHP mit Homebrew installieren:
                    brew install php
       
        3. Installieren von Composer
                Composer ist ein Abhängigkeitsmanager für PHP. Installieren Sie Composer mit dem folgenden Befehl:
                    brew install composer
       
        4. Installieren von MySQL
                Installieren Sie MySQL mit Homebrew:
                     brew install mysql
        
        5. Starten Sie den MySQL-Server:
                    brew services start mysql
        
        6. Erstellen eines neuen Laravel-Projekts
                Erstellen Sie ein neues Laravel-Projekt mit Composer:
                    composer create-project --prefer-dist laravel/laravel meinProjekt
    
    
    
    Windows
        1. Installieren von XAMPP
             XAMPP ist eine PHP-Entwicklungsumgebung, die Apache, MariaDB (eine MySQL-Datenbank), PHP und Perl umfasst. Laden Sie XAMPP von der offiziellen Website herunter und folgen Sie den Installationsanweisungen.

        2. Installieren von Composer
            Laden Sie den Composer-Installer von der offiziellen Website herunter und führen Sie ihn aus.
        Folgen Sie den Anweisungen des Installers. Stellen Sie sicher, dass Sie den Pfad zur php.exe in Ihrer XAMPP-Installation angeben, wenn danach gefragt wird.
        
        3. Erstellen eines neuen Laravel-Projekts
            Öffnen Sie die Eingabeaufforderung oder PowerShell und führen Sie den folgenden Befehl aus, um ein neues Laravel-Projekt zu erstellen:
                composer create-project --prefer-dist laravel/laravel meinProjekt
       
        4. Starten von MySQL
             Starten Sie den XAMPP-Control-Panel und starten Sie den MySQL-Dienst.
        Sie können phpMyAdmin in Ihrem Browser öffnen, indem Sie zu http://localhost/phpmyadmin navigieren, um Ihre Datenbanken zu verwalten.

#### Aufbau Code:

### Item: 
    - ArticleController.php
            - createItem(): Gibt die Ansicht items.createItem zurück.
            - show(Item $item): Gibt die Ansicht items.show mit dem übergebenen Artikelobjekt zurück.
            - store(Request $request): Speichert einen neuen Artikel basierend auf den übermittelten Formulardaten. Validiert die Eingaben, speichert das Bild in den Speicher, erstellt einen neuen Artikel und speichert ihn in der Datenbank.
            - index(Request $request): Zeigt eine Liste von Artikeln basierend auf dem Suchbegriff an, wenn vorhanden, oder zeigt die neuesten 20 Artikel an.
            - update(Request $request, Item $item): Aktualisiert die Daten eines vorhandenen Artikels basierend auf den übermittelten Formulardaten. Validiert das Bild, speichert es im Speicher, aktualisiert den Artikel und das Bild in der Datenbank.

    - Item.php (Modell)
        - user(): Definiert die Beziehung zu einem Benutzer (Ein Artikel gehört einem Benutzer).
        - messages(): Definiert die Beziehung zu Nachrichten (Ein Artikel kann mehrere Nachrichten haben).
        - items(): Definiert die Beziehung zu anderen Artikeln (Ein Artikel kann mehrere Unterkategorien haben).
        
        
    createItem.blade.php
        - Ansicht zur Erstellung eines neuen Artikels.
        - Enthält ein Formular zur Eingabe von Titel, Beschreibung, Preis und Foto.
        - Validiert die Eingaben und zeigt Fehlermeldungen an, falls vorhanden.
        - Verwendet das x-app-layout Blade-Komponente für das Layout.


    edit.blade.php
        - Ansicht zur Bearbeitung eines vorhandenen Artikels.
        - Enthält ein Formular zur Bearbeitung von Titel, Beschreibung und Foto.
        - Anzeigt das aktuelle Bild des Artikels (falls vorhanden).
        - Validiert die Eingaben und zeigt Fehlermeldungen an, falls vorhanden.
        - Verwendet das x-app-layout Blade-Komponente für das Layout.


show.blade.php
        - Ansicht zur Anzeige der Details eines Artikels.
        - Zeigt Titel, Beschreibung, Bild und Preis des Artikels an.
        - Bietet die Möglichkeit, dem Verkäufer eine Nachricht zu senden.
        - Verwendet das x-app-layout Blade-Komponente für das Layout.

### User:


#### `UserController.php`

  - `edit(User $user)`: Gibt die Ansicht `users.edit` mit dem übergebenen Benutzerobjekt zurück.

#### `User.php` (Modell)
- Attribute:
  - `$fillable`: Erlaubt Massenzuweisung für die angegebenen Attribute.
  - `$hidden`: Definiert Attribute, die bei der Serialisierung ausgeblendet werden sollen.
  - `$casts`: Definiert die Typumwandlung für bestimmte Attribute.
- Methoden:
  - `sentMessages()`: Definiert die Beziehung zu den gesendeten Nachrichten eines Benutzers.
  - `receivedMessages()`: Definiert die Beziehung zu den empfangenen Nachrichten eines Benutzers.
  - `items()`: Definiert die Beziehung zu den Artikeln, die ein Benutzer erstellt hat.
  - `hasNewMessages()`: Überprüft, ob der Benutzer neue ungelesene Nachrichten hat.

#### Bemerkungen

- Das Modell `User` repräsentiert einen Benutzer im System.
- Es enthält Methoden zur Definition von Beziehungen zu anderen Modellen wie Nachrichten und Artikeln.
- Das Modell ermöglicht die Massenzuweisung von Attributen, hat versteckte Attribute und definiert die Typumwandlung für bestimmte Attribute.
- Der `UserController` steuert die Ansicht zur Bearbeitung eines Benutzers.
- Die Ansicht `users.edit` wird mit dem übergebenen Benutzerobjekt aufgerufen, um Benutzerdaten zu bearbeiten.

Message:
#### `MessageController.php`

- Namespace: `App\Http\Controllers`
- Verwendung: `App\Models\Message`, `App\Models\Item`, `App\Models\User`, `Illuminate\Http\Request`, `Carbon\Carbon`, `Illuminate\Support\Facades\Storage`
- Methoden:
  - `checkForNewMessages()`: Überprüft, ob der aktuelle Benutzer neue ungelesene Nachrichten hat und gibt eine JSON-Antwort zurück.
  - `create(User $recipient, $articleId)`: Gibt die Ansicht `messages.create` mit dem Empfänger und der Artikel-ID zurück.
  - `store(Request $request)`: Speichert eine neue Nachricht basierend auf den vom Benutzer bereitgestellten Daten.
  - `index()`: Zeigt die Nachrichtenübersicht an, gruppiert Nachrichten nach Konversationen und zeigt die neuesten Nachrichten an.
  - `conversation(User $user, $articleId)`: Zeigt eine Konversation zwischen dem aktuellen Benutzer und einem anderen Benutzer zu einem bestimmten Artikel an.
  - `reply(Request $request, User $user, $articleId)`: Erstellt und speichert eine Antwortnachricht auf eine bestehende Konversation.
  - `markConversationAsRead($conversationId)`: Markiert alle Nachrichten in einer Konversation als gelesen.
  - `markAsRead($messageId)`: Markiert eine spezifische Nachricht als gelesen.

#### `Message.php` (Modell)

- Attribute:
  - `$fillable`: Erlaubt Massenzuweisung für die angegebenen Attribute.
- Methoden:
  - `sender()`: Definiert die Beziehung zu dem Benutzer, der die Nachricht gesendet hat.
  - `article()`: Definiert die Beziehung zu dem Artikel, auf den sich die Nachricht bezieht.
  - `recipient()`: Definiert die Beziehung zum Empfänger der Nachricht.
  - `isUnreadByAuthUser()`: Bestimmt, ob die Nachricht ungelesen ist und der Empfänger der aktuell authentifizierte Benutzer ist.

#### Ansichten

1. `conversation.blade.php`: Ansicht zur Anzeige einer Konversation zwischen Benutzern zu einem bestimmten Artikel.
2. `create.blade.php`: Ansicht zur Erstellung einer neuen Nachricht.
3. `index.blade.php`: Ansicht zur Anzeige der Nachrichtenübersicht und der neuesten Konversationen.
4. `show.blade.php`: Ansicht zur Anzeige einer einzelnen Nachricht.

#### Bemerkungen

- Der `MessageController` steuert die Erstellung, Speicherung und Anzeige von Nachrichten.
- Das `Message`-Modell repräsentiert eine Nachricht im System und definiert Beziehungen zu Benutzern und Artikeln.
- Die Ansichten ermöglichen Benutzern das Anzeigen von Nachrichten, das Erstellen neuer Nachrichten und das Anzeigen von Konversationen.

### Profil:

Die gegebene PHP-Klasse `ProfileController` ist ein Laravel-Controller, der verschiedene Methoden zur Verwaltung von Benutzerprofilen implementiert. Hier ist eine kurze technische Dokumentation der enthaltenen Funktionen:

### Funktionen:

1. `destroyItem(Item $item)`: Diese Methode löscht einen Artikel aus der Datenbank und leitet den Benutzer zur vorherigen Seite zurück.

2. `edit()`: Lädt die Profilbearbeitungsansicht mit den Daten des angemeldeten Benutzers und seinen Artikeln.

3. `updatePicture(Request $request)`: Aktualisiert das Profilbild des Benutzers und speichert es im öffentlichen Speicher.

4. `update(ProfileUpdateRequest $request)`: Aktualisiert die Profilinformationen des Benutzers und leitet ihn zur Profilbearbeitungsseite zurück.

5. `destroy(Request $request)`: Löscht das Benutzerkonto nach Bestätigung durch Eingabe des aktuellen Passworts.

### Verwendete Klassen und Komponenten:

- `ProfileUpdateRequest`: Eine benutzerdefinierte Anfrageklasse zur Validierung von Profilaktualisierungsanforderungen.

- `Item`: Ein Laravel-Modell, das für die Datenbankinteraktion mit Artikeln verwendet wird.

- `Auth`: Die Laravel-Fassade für die Authentifizierung und das Management von Benutzeranmeldungen.

- `Redirect`: Eine Laravel-Fassade zur Generierung von HTTP-Weiterleitungsantworten.

### Ansichten:

- `profile.edit.blade.php`: Die Blade-Ansicht für die Profilbearbeitungsseite, die verschiedene Formulare und Aktionen enthält, einschließlich der Anzeige von Profilinformationen, des Bilduploads, der Passwortänderung und der Kontolöschung.

- Teilansichten (`partials`): Diese Blade-Dateien enthalten Teile der Profilbearbeitungsansicht, wie z. B. das Formular für die Aktualisierung der Profilinformationen, das Formular für die Passwortänderung und das Formular für die Kontolöschung.

### JavaScript und Styling:

- `Alpine.js`: Eine JavaScript-Bibliothek für die Erstellung von benutzerdefinierten interaktiven Webanwendungen, die für das Accordion in der Profilansicht verwendet wird.

- `SweetAlert2`: Eine JavaScript-Bibliothek für die Anzeige von ansprechenden Dialogen, die für die Bestätigung des Artikellöschvorgangs verwendet wird.

### Weitere Hinweise:

- Die Verwendung von Fassaden wie `Auth`, `Redirect` und benutzerdefinierten Anfrageklassen zeigt die Verwendung von Laravel-Features zur Vereinfachung der Codeorganisation und -entwicklung.

- Die Ansichten sind in der Laravel-Blade-Templating-Syntax geschrieben und verwenden Bootstrap-Klassen für das Styling und die Anordnung von HTML-Elementen.

Diese Dokumentation bietet eine Zusammenfassung der Funktionalitäten und Technologien, die in der gegebenen PHP-Klasse und den zugehörigen Ansichten verwendet werden.

### Auth:
Die bereitgestellten Codefragmente enthalten mehrere Controller und Blade-Templates für die Benutzerauthentifizierung in einer Laravel-Anwendung. Hier ist eine kurze technische Dokumentation zu jedem Controller:

1. **NewPasswordController**:
   - **create(Request $request): View**: Zeigt die Ansicht zum Zurücksetzen des Passworts an.
   - **store(Request $request): RedirectResponse**: Behandelt eine eingehende Anfrage zum Zurücksetzen des Passworts. Validiert die Anfrageparameter, setzt das Passwort zurück und leitet je nach Status des Passwortzurücksetzens um.

2. **PasswordController**:
   - **update(Request $request): RedirectResponse**: Aktualisiert das Passwort des Benutzers. Überprüft das aktuelle Passwort des Benutzers, validiert das neue Passwort und aktualisiert es dann in der Datenbank.

3. **PasswordResetLinkController**:
   - **create(): View**: Zeigt die Ansicht zum Anfordern eines Passwort-Zurücksetzungslinks an.
   - **store(Request $request): RedirectResponse**: Behandelt eine eingehende Anfrage zum Senden eines Passwort-Zurücksetzungslinks. Validiert die E-Mail-Adresse und sendet dann den Zurücksetzungslink.

4. **RegisterController**:
   - **showRegistrationForm(): View**: Zeigt das Registrierungsformular an. Es erstellt auch einen neuen Benutzer in der Datenbank und meldet ihn nach erfolgreicher Registrierung automatisch an.

5. **RegisteredUserController**:
   - **create(): View**: Zeigt das Registrierungsformular an.
   - **store(Request $request): RedirectResponse**: Behandelt eine eingehende Registrierungsanfrage. Validiert die Anfrageparameter, erstellt einen neuen Benutzer in der Datenbank und meldet ihn nach erfolgreicher Registrierung an.

6. **VerifyEmailController**:
   - **__invoke(EmailVerificationRequest $request): RedirectResponse**: Markiert die E-Mail-Adresse des authentifizierten Benutzers als verifiziert und leitet dann um.

Jedes Blade-Template (`confirm-password.blade.php`, `forgot-password.blade.php`, `login.blade.php`, `register.blade.php`, `reset-password.blade.php`, `verify-email.blade.php`) dient dazu, verschiedene Ansichten im Benutzerbereich anzuzeigen, z. B. das Anmeldeformular, das Registrierungsformular, das Passwort-Wiederherstellungsformular usw.

Die Kommentare im Code bieten zusätzliche Details zu den Funktionen und Zwecken der einzelnen Abschnitte.


### Admin:
#### **Übersicht:**
Die vorliegende Dokumentation beschreibt eine Reihe von Funktionen in einem PHP Laravel Projekt, die zur Verwaltung von Benutzern und Artikeln verwendet werden. Es gibt einen `AdminController`, der für das Dashboard und die Verwaltung der Benutzer und Artikel zuständig ist. Die Ansichten sind in Blade-Templates geschrieben und verwenden Alpine.js für interaktive Funktionen.

#### **Kernfunktionalitäten:**

1. **`dashboard()` Methode:**
   - Holt alle Benutzer und gibt sie in einer Dashboard-Ansicht aus.
   
2. **`editUser(User $user)` Methode:**
   - Zeigt ein Formular zur Bearbeitung eines Benutzers an.
   
3. **`updateUser(Request $request, User $user)` Methode:**
   - Validiert und aktualisiert die Benutzerdaten.
   
4. **`destroyUser(User $user)` Methode:**
   - Löscht einen Benutzer und alle zugehörigen Artikel.
   
5. **`editArticle(Item $item)` Methode:**
   - Zeigt ein Formular zur Bearbeitung eines Artikels an.
   
6. **`updateArticle(Request $request, Item $item)` Methode:**
   - Validiert und aktualisiert die Artikeldaten.
   
7. **`destroyArticle(Item $item)` Methode:**
   - Löscht einen Artikel.
   
8. **`searchUser(Request $request)` Methode:**
   - Sucht nach Benutzern basierend auf dem Suchbegriff.
   
#### **Blade-Templates:**

1. **`admin/dashboard.blade.php`:**
   - Zeigt das Admin-Dashboard an, einschließlich der Benutzerverwaltung.
   - Enthält ein Suchformular für Benutzer.
   - Verwendet Akkordeons, um Benutzerdetails und Artikel anzuzeigen.

2. **`admin/editArticle.blade.php`:**
   - Ermöglicht die Bearbeitung von Artikeln durch ein Formular.
   - Enthält eine Funktion zum Löschen von Artikeln mit Bestätigungsdialog.

3. **`admin/partials/editUserArticles.blade.php`:**
   - Zeigt eine Liste der Artikel eines bestimmten Benutzers an.
   - Enthält Optionen zum Bearbeiten und Löschen von Artikeln.

4. **`admin/partials/editUserForm.blade.php`:**
   - Zeigt ein Formular zur Bearbeitung von Benutzerinformationen an.
   - Enthält auch eine Schaltfläche zum Löschen des Benutzers mit einem Bestätigungsdialog.

#### **Weitere Hinweise:**
- Das Projekt verwendet Laravel, ein PHP-Framework zur Erstellung von Webanwendungen.
- Die Validierung von Benutzereingaben erfolgt in den Controller-Methoden.
- Alpine.js wird für interaktive Funktionen wie Akkordeons und Bestätigungsdialoge verwendet.
- Die Blade-Templates enthalten Inline-PHP-Code zur dynamischen Generierung von HTML-Inhalten.


### Unittest:
terminal: php vendor/bin/phpunit tests/Unit/createItem.php

#### User zum testen:

Testuser:
name: TestUser
email testuser@test.com
passwort test1234

TestUser2:
name: BeispielUser
email beispieluser@beispiel.de
passwort beispiel1234

Adminuser
name: admin
email admin@admin.com
passwort admin
=======
# artSellPlattform
>>>>>>> 30cf95e5de416c225449789e46d876f401faa0cd
