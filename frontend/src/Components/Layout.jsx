import React from 'react';
import '../index.css'; // assuming your CSS is compiled into app.css

const Layout = ({ header, children }) => {
  return (
    <div className="base-color-light font-sans antialiased">
      <head>
        <meta charSet="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="csrf-token" content="YOUR_CSRF_TOKEN" />
    

        <title>YOUR_APP_NAME</title>

        {/* Fonts */}
        <link rel="preconnect" href="https://fonts.bunny.net" />
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        {/* Scripts */}
        <script src="/js/checkMessages.js" defer></script>
        <script src="//unpkg.com/alpinejs" defer></script>
      </head>

      {/* Page Heading */}
      {header && (
        <header className="base-color-light">
          <div className="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            {header}
          </div>
        </header>
      )}

      {/* Page Content */}
      <main>
        {children}
      </main>
    </div>
  );
};

export default Layout;
