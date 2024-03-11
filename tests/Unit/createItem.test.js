describe('Artikelanzeige Erstellung', () => {
    // Erhöhe das Timeout für die Setup-Funktion
    beforeAll(async () => {
      // Navigiere zur Login-Seite
      await page.goto('http://127.0.0.1:8000/login', { waitUntil: 'networkidle0' });
      // Fülle das Login-Formular aus und logge dich ein
      await page.type('input[name=email]', 'testuser@test.om'); // Nutze hier die E-Mail-Adresse deines Testbenutzers
      await page.type('input[name=password]', 'test1234'); // Nutze hier das Passwort deines Testbenutzers
      await page.click('button[type=submit]');
      await page.waitForNavigation();
  
      // Navigiere zur Artikelanzeige-Erstellungsseite
      await page.goto('http://127.0.0.1:8000/items/create', { waitUntil: 'networkidle0' });
    }, 20000); // Erhöhtes Timeout, um sicherzustellen, dass das Einloggen und die Navigation genügend Zeit haben
  
    it('sollte die Seite korrekt laden', async () => {
        const title = await page.title();
        expect(title).toMatch('Post Article'); // Ersetze 'Post Article' mit dem tatsächlichen Titel der Seite, falls abweichend
      }, 20000);

  });
  