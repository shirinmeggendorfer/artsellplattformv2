import '../index.css';

const Navbar = () => {
    return (
      <nav className="light-color p-4 text-white fixed inset-x-0 bottom-0 flex justify-around">
          <a href="/" className="iconHome">Startseite</a>
          <a href="/messages" className="iconMessage">Nachrichten</a>
          <a href="/new-article" className="iconAddAd">Artikel erstellen</a>
          <a href="/profile" className="iconProfile">Profil</a>
      </nav>
    );
  };
  
  export default Navbar;
  