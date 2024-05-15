import { useState } from 'react';

const InputFile = ({ name, label, ...props }) => {
  const [preview, setPreview] = useState('');

  const readURL = (input) => {
    if (input.files && input.files[0]) {
      const reader = new FileReader();
      reader.onload = function(e) {
        setPreview(e.target.result);
      };
      reader.readAsDataURL(input.files[0]);
    }
  };

  return (
    <div>
      {label && <InputLabel value={label} />}
      <label htmlFor={name}>
        <input
          type="file"
          id={name}
          name={name}
          accept="image/*"
          className="hidden"
          onChange={(e) => readURL(e.target)}
          {...props}
        />
      </label>
      {preview && <img src={preview} alt="Preview" style={{ maxWidth: '100px', maxHeight: '100px', marginTop: '10px' }} />}
    </div>
  );
};
