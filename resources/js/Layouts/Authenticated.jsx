import React from 'react';
import { Link } from '@inertiajs/inertia-react';

export default function Authenticated({ auth, header, children }) {
    return (
        <div>
            {header && (
                <header>
                    <div>{header}</div>
                </header>
            )}

            <div>{auth.user.name}</div>

            <Link method="post" href={route('logout')} as="button">
                Log Out
            </Link>

            <main>{children}</main>
        </div>
    );
}
