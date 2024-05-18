import React, { useState, useEffect } from 'react';
import Layout from './Layout'; // Importieren der Layout-Komponente
import NavBar from './NavBar';
import '../index.css';

const fetchItems = async () => {
  const response = await fetch('http://localhost:8000/api/items');
  if (response.ok) {
    return response.json();
  }
  return [];
};

const searchItems = async (searchQuery) => {
  const response = await fetch(`http://localhost:8000/search?search=${encodeURIComponent(searchQuery)}`);
  if (response.ok) {
    return response.json();
  }
  return [];
};

function StartPage() {
  const [items, setItems] = useState([]);
  const [search, setSearch] = useState('');

  useEffect(() => {
    if (search) {
      searchItems(search).then(setItems);
    } else {
      fetchItems().then(setItems);
    }
  }, [search]);

  const handleSubmit = async (event) => {
    event.preventDefault();
    if (!search.trim()) return;
    const results = await searchItems(search);
    setItems(results);
  };

  const header = (
    <div className="flex justify-between items-center px-5 py-5">
      <div className="websiteLogo"></div>
      <span className="h1-text">AppName</span>
    </div>
  );

  return (
    <Layout header={header}>
      <div className="light:base-color-light app-layout">
        <div className="light:base-color-light fixed top-0 z-50 w-full mb-2 shadow">
          <form id="searchForm" onSubmit={handleSubmit} className="base-color-light flex justify-center pt-5 px-5">
            <input
              type="text"
              name="search"
              id="searchInput"
              placeholder="Suche..."
              className="form-control w-full px-5 h-12 content-text light-color dark-placeholder"
              value={search}
              onChange={(e) => setSearch(e.target.value)}
            />
            <button type="submit" id="searchButton" className="ml-2 px-5 accent-color">
              Suchen
            </button>
          </form>
        </div>
        <div className="pt-16">
          <h2 className="h2-text text-left mt-4 mb-6 px-5">zuletzt hochgeladen</h2>
          {items.map(item => (
            <a key={item.id} href={`/items/${item.id}`} className="px-5 w-full block text-black no-underline">
              <img className="article-image br-cards" src={`backend/storage/app/public/photos/${item.photo}`} alt="Artikel Foto" />
              <div className="px-5 py-1">
                <div className="h3-text mb-1">{item.title}</div>
                <p className="content-text">
                  {item.price} €
                </p>
              </div>
            </a>
          ))}
          <div className='mb-20'> </div>
        </div>
        <NavBar />
      </div>
    </Layout>
  );
}

export default StartPage;
