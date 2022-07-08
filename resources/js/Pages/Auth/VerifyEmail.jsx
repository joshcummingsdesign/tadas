import React from 'react';
import Button from '@/Components/Button';
import Guest from '@/Layouts/Guest';
import { Head, Link, useForm } from '@inertiajs/inertia-react';

export default function VerifyEmail({ status }) {
    const { post, processing } = useForm();

    const submit = (e) => {
        e.preventDefault();
        post(route('verification.send'));
    };

    return (
        <Guest>
            <Head title="Email Verification" />

            <div>
                Thanks for signing up! Before getting started, could you verify your email address by clicking on the
                link we just emailed to you? If you didn't receive the email, we will gladly send you another.
            </div>

            {status === 'verification-link-sent' && (
                <div>
                    A new verification link has been sent to the email address you provided during registration.
                </div>
            )}

            <form onSubmit={submit}>
                <div>
                    <Button processing={processing}>Resend Verification Email</Button>
                    <Link
                        href={route('logout')}
                        method="post"
                        as="button">
                        Log Out
                    </Link>
                </div>
            </form>
        </Guest>
    );
}
