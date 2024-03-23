// Erkennt das Farbschema des Betriebssystems
function detectColorScheme() {
    var theme = 'light'; // Standardmäßig auf Hellmodus setzen

    if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
        theme = 'dark'; // Wenn das Betriebssystem den Dunkelmodus bevorzugt, das Farbschema auf Dunkelmodus setzen
    }

    // Klassen auf den body-Tag anwenden
    document.body.classList.add(theme === 'dark' ? 'dark' : 'light');
}

// Die Funktion aufrufen, sobald die Seite geladen ist
window.onload = detectColorScheme;
