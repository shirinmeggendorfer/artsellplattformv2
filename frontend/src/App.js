import React from 'react';
import './index.css';
import {
  BrowserRouter as Router,
  Routes,  
  Route,
} from 'react-router-dom';
import ArticleDisplay from './pages/article/ArticleDisplay';
import StartPage from './Components/StartPage';  

// Layout Komponente
function Layout({ children }) {
    return (
        <div>
            {/* Kopfbereich */}
            <header className="light:base-color-light dark:base-color-dark">
                <div className="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {/* Hier könnte dynamischer Inhalt oder Navigation sein */}
                </div>
            </header>
            {/* Hauptinhalt */}
            <main>
                {children}
            </main>
        </div>
    );
}

function App() {
  return (
    <Router>
      <Layout>
        <Routes> 
          <Route path="/" element={<StartPage />} /> 
          <Route path="/items/:itemId" element={<ArticleDisplay />} /> 
        </Routes>
      </Layout>
    </Router>
  );
}

export default App;
