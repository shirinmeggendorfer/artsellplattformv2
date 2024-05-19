const Button = ({ children, className, ...props }) => (
    <button
      className={`inline-flex items-center px-4 py-2 border border-transparent light-color rounded-md content-text-small tracking-widest hover:accent-color active:main-color-light-mode  focus:outline-none disabled:opacity-25 transition ease-in-out duration-150 br-buttons ${className}`}
      {...props}
    >
      {children}
    </button>
  );
  