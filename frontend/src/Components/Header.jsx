const Header = ({ title }) => (
    <header className="light:base-color-light dark: base-color-dark">
        <div className="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h2 className="h2-text leading-tight">{title}</h2>
        </div>
    </header>
);

export default Header;
