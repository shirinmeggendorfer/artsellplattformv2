#### Setup:
- Docker starten
- Terminal öffnen
- cd Projektpfad
- RUN docker-compose up --build

Hinweis: eventuell muss die Datenbank manuell migriert werden (wenn man keine Daten sieht):
- hierzu im Terminal (erst nachdem man in den log: " backend-1   |    INFO  Server running on [http://0.0.0.0:8000]."  sieht )
- RUN docker exec -it <Container Id> php artisan migrate
- Die Container Id sieht man mit dem Command "Docker ps"



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


## Unittest
### Unittest:
Pfad zum test:
backend/tests/Unit/createItem.php

Testcase:
Lädt ein Artikel hoch 

Testausführung
RUN docker exec -it <container-id> php vendor/bin/phpunit tests/Unit/createItem.php




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


#### Backend APIs

# Authentifizierung und Registrierung

Route: POST /register

Controller: RegisterController@register
Beschreibung: Registriert einen neuen Benutzer.
Route: POST /login

Controller: AuthenticatedSessionController@login
Beschreibung: Authentifiziert einen Benutzer und startet eine Sitzung.
Route: POST /logout

Controller: AuthenticatedSessionController@destroy
Middleware: auth:sanctum
Beschreibung: Beendet die Sitzung eines authentifizierten Benutzers.
Passwort zurücksetzen

Route: POST /forgot-password

Controller: PasswordResetLinkController@store
Beschreibung: Sendet einen Link zum Zurücksetzen des Passworts an die E-Mail des Benutzers.
Route: POST /reset-password

Controller: NewPasswordController@store
Beschreibung: Setzt das Passwort eines Benutzers zurück.
Route: PUT /password/update

Controller: PasswordController@update
Middleware: auth:sanctum
Beschreibung: Aktualisiert das Passwort eines authentifizierten Benutzers.
E-Mail-Verifizierung

# Route: GET /verify-email

Controller: EmailVerificationPromptController@__invoke
Middleware: auth:sanctum
Beschreibung: Zeigt die E-Mail-Verifizierungsaufforderung an.
Route: POST /email/verification-notification

Controller: EmailVerificationNotificationController@store
Middleware: auth:sanctum
Beschreibung: Sendet eine E-Mail zur Verifizierung an den Benutzer.
Route: GET /verify-email/{id}/{hash}

Controller: VerifyEmailController@__invoke
Middleware: auth:sanctum, signed
Name: verification.verify
Beschreibung: Verifiziert die E-Mail-Adresse eines Benutzers.
Passwort bestätigen

Route: POST /password/confirm
Controller: ConfirmablePasswordController@store
Middleware: auth:sanctum
Beschreibung: Bestätigt das Passwort eines authentifizierten Benutzers.
Artikelverwaltung


# Route: GET /items

Controller: ArticleController@index
Beschreibung: Listet alle Artikel auf.
Route: GET /items/{item}

Controller: ArticleController@show
Beschreibung: Zeigt die Details eines bestimmten Artikels an.
Route: POST /items

Controller: ArticleController@store
Middleware: auth:sanctum
Beschreibung: Erstellt einen neuen Artikel.
Route: PUT /items/{item}

Controller: ArticleController@update
Middleware: auth:sanctum
Beschreibung: Aktualisiert einen bestimmten Artikel.
Route: DELETE /items/{item}

Controller: ArticleController@destroy
Middleware: auth:sanctum
Beschreibung: Löscht einen bestimmten Artikel.
Nachrichtenverwaltung

# Route: GET /messages/check-new

Controller: MessageController@checkForNewMessages
Middleware: auth:sanctum
Beschreibung: Überprüft, ob es neue Nachrichten für den authentifizierten Benutzer gibt.
Route: GET /messages

Controller: MessageController@index
Middleware: auth:sanctum
Beschreibung: Listet alle Nachrichten des authentifizierten Benutzers auf.
Route: POST /messages

Controller: MessageController@store
Middleware: auth:sanctum
Beschreibung: Erstellt eine neue Nachricht.
Route: GET /messages/{id}

Controller: MessageController@show
Middleware: auth:sanctum
Beschreibung: Zeigt die Details einer bestimmten Nachricht an.
Route: GET /conversations/{user}/{articleId}

Controller: MessageController@conversation
Middleware: auth:sanctum
Beschreibung: Zeigt die Konversation zwischen dem authentifizierten Benutzer und einem anderen Benutzer zu einem bestimmten Artikel an.
Benutzerprofil

# Route: GET /user

Controller: ProfileController@getUser
Middleware: auth:sanctum
Beschreibung: Gibt die Informationen des authentifizierten Benutzers zurück.
Route: GET /profile

Controller: ProfileController@edit
Middleware: auth:sanctum
Beschreibung: Zeigt das Formular zum Bearbeiten des Benutzerprofils an.
Route: POST /profile

Controller: ProfileController@update
Middleware: auth:sanctum
Beschreibung: Aktualisiert die Profildaten des authentifizierten Benutzers.
Route: POST /profile/picture

Controller: ProfileController@updatePicture
Middleware: auth:sanctum
Beschreibung: Aktualisiert das Profilbild des authentifizierten Benutzers.
Route: DELETE /users/{id}

Controller: ProfileController@destroyUser
Middleware: auth:sanctum
Beschreibung: Löscht den Benutzer mit der angegebenen ID.
Route: DELETE /profile/item/{item}

Controller: ProfileController@destroyItem
Middleware: auth:sanctum
Beschreibung: Löscht einen bestimmten Artikel des authentifizierten Benutzers.
Admin-Funktionen

# Route: GET /admin/dashboard

Controller: AdminController@getUsers
Middleware: auth:sanctum
Beschreibung: Listet alle Benutzer auf.
Route: GET /admin/users/{user}

Controller: AdminController@getUser
Middleware: auth:sanctum
Beschreibung: Gibt die Informationen eines bestimmten Benutzers zurück.
Route: PUT /admin/users/{user}

Controller: AdminController@updateUser
Middleware: auth:sanctum
Beschreibung: Aktualisiert die Informationen eines bestimmten Benutzers.
Route: DELETE /admin/users/{user}

Controller: AdminController@destroyUser
Middleware: auth:sanctum
Beschreibung: Löscht einen bestimmten Benutzer.
Route: GET /admin/users/{user}/items

Controller: AdminController@getUserItems
Middleware: auth:sanctum
Beschreibung: Listet alle Artikel eines bestimmten Benutzers auf.
Route: GET /admin/items/{item}

Controller: AdminController@getArticle
Middleware: auth:sanctum
Beschreibung: Gibt die Informationen eines bestimmten Artikels zurück.
Route: PUT /admin/items/{item}

Controller: AdminController@updateArticle
Middleware: auth:sanctum
Beschreibung: Aktualisiert einen bestimmten Artikel.
Route: DELETE /admin/items/{item}

Controller: AdminController@destroyArticle
Middleware: auth:sanctum
Beschreibung: Löscht einen bestimmten Artikel.
Route: GET /admin/search

Controller: AdminController@searchUser
Middleware: auth:sanctum
Beschreibung: Durchsucht die Benutzer nach bestimmten Kriterien.
Sonstiges

# Route: GET /search

Controller: HomeController@startPage
Beschreibung: Durchsucht die Startseite nach Artikeln.
Route: GET /homeitems

Controller: HomeController@index
Beschreibung: Listet alle Artikel auf der Startseite auf.
Route: GET /sanctum/csrf-cookie

Controller: Laravel\Sanctum\Http\Controllers\CsrfCookieController@show
Name: sanctum.csrf-cookie
Middleware: api
Beschreibung: Gibt das CSRF-Token für die Sitzung zurück.


##### Frontend 

# App.js
- Layout ist hier definiert
- Mapping URL - Views

# index.css
- globales CSS Sheet (übernommen vom ehemaligen Laravel projekt)

# pages 

# admin
- Admin Dashboard 
    - Userverwaltung mit Suchleiste
- EditUser
    - View zum User bearbeiten
- EditUserArtikel
    - Integriert in der EditUserview
    - Ermöglicht das bearbeiten von User Artikel

# artikel
- ArticleCreate
    - View zum Artikelerstellen
- ArticleDisplay
    - View zum Artikel anzeigen
    - Produktansicht
- ArticleEdit 
    - View zum User Arikel bearbeiten auf der Profilseite

# messages
- MessageConversation
    - View zum Nachrichtenverlauf
- MessageCreate
    - die view beim Anschreiben in der Produktansicht
- MessageIndex
    - die Nachrichtenübersichtsview
- MessageShow 
    - wird nicht genutzt 

# profile
- delete-user-form
    - View zum Profillöschen 
    - in profile edit integriert
- edit
    - die Profilübersichts view 
- update-password-form
    - view zum Passwort ändern
    - in edit integriert
    - update-user-form