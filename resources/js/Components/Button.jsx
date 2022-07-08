import React from 'react';

export default function Button({ type = 'submit', className, processing, children }) {
    return (
        <button className={className} type={type} disabled={processing}>
            {children}
        </button>
    );
}
