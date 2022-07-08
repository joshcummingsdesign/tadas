import React from 'react';

export default function Checkbox({ name, value, className, handleChange }) {
    return (
        <input
            type="checkbox"
            name={name}
            value={value}
            className={className}
            onChange={(e) => handleChange(e)}
        />
    );
}
