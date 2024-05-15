const InputLabel = ({ children, className, ...props }) => (
    <label className={`block content-text ${className}`} {...props}>
      {children}
    </label>
  );
  