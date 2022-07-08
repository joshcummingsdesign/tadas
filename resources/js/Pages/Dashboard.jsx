import React from 'react';
import Authenticated from '@/Layouts/Authenticated';
import { Head } from '@inertiajs/inertia-react';

export default function Dashboard(props) {
    return (
        <Authenticated
            auth={props.auth}
            errors={props.errors}
            header={<h2>Dashboard</h2>}>

            <Head title="Dashboard" />

            <div>You're logged in!</div>
        </Authenticated>
    );
}
