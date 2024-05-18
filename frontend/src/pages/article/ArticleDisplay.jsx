import React, { useState, useEffect } from 'react';
import { useParams } from 'react-router-dom';
import '../../index.css';
import NavBar from '../../Components/NavBar';

const fetchItem = async (itemId) => {
  const response = await fetch(`http://localhost:8000/api/items/${itemId}`);
  if (response.ok) {
    return response.json();
  }
  return null;
};

function ArticleDisplay() {
  const { itemId } = useParams();  // Holen der itemId aus der URL
  const [item, setItem] = useState(null);

  useEffect(() => {
    if (itemId) {
      fetchItem(itemId).then(setItem);
    }
  }, [itemId]);

  if (!item) {
    return <div>Loading...</div>;
  }

  return (
   
<div className="light:base-color-light fixed top-0 z-50 w-full mb-2 shadow">
    <div className="max-w-4xl mx-auto sm:px-6 lg:px-8 py-6">
        <div className="sm:rounded-lg">
            <div className="px-4 py-5 sm:px-6">
            <h3 className="h3-text">{item.title}</h3>
            <p className="mt-1 max-w-2xl content-text">Verkäufer: item.user.name</p>
            </div>

            <div className="px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
            <img src={`http://localhost:8000/storage/photos/${item.photo}`} alt={item.title} />
            </div>

            <div className="px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
            <dt className="h3-text">Beschreibung</dt>
            <dd className="content-text">{item.description}</dd>
            </div>

            <div className="px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
            <dt className="content-text">Preis</dt>
            <dd className="content-text">{item.price} €</dd>
            </div>
        </div>

        <div className="mt-5 flex justify-end px-5">
            {item.canContact ? (
            <a href={`/messages/create/${item.user.id}/${item.id}`} className="light-color hover:accent-color content-text-small py-2 px-4 br-buttons">
                Anschreiben
            </a>
            ) : (
            <a href="/login" className="light-color hover:accent-color content-text py-2 px-4 br-buttons no-underline">
                Anschreiben
            </a>
            )}
        </div>
        <div className='mb-20'> </div>
        </div>
     
      <NavBar />
</div>


  );
}

export default ArticleDisplay;
