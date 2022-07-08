import React, { useEffect } from 'react';
import Button from '@/Components/Button';
import Checkbox from '@/Components/Checkbox';
import Guest from '@/Layouts/Guest';
import Input from '@/Components/Input';
import Label from '@/Components/Label';
import ValidationErrors from '@/Components/ValidationErrors';
import { Head, Link, useForm } from '@inertiajs/inertia-react';

export default function Login({ status, canResetPassword }) {
    const { data, setData, post, processing, errors, reset } = useForm({
        email: '',
        password: '',
        remember: '',
    });

    useEffect(() => {
        return () => {
            reset('password');
        };
    }, []);

    const onHandleChange = (event) => {
        setData(event.target.name, event.target.type === 'checkbox' ? event.target.checked : event.target.value);
    };

    const submit = (e) => {
        e.preventDefault();
        post(route('login'));
    };

    return (
        <Guest>
            <Head title="Log in" />

            {status && <div>{status}</div>}

            <ValidationErrors errors={errors} />

            <form onSubmit={submit}>
                <div>
                    <Label forInput="email" value="Email" />
                    <Input
                        type="text"
                        name="email"
                        value={data.email}
                        autoComplete="username"
                        isFocused={true}
                        handleChange={onHandleChange}
                    />
                </div>
                <div>
                    <Label forInput="password" value="Password" />
                    <Input
                        type="password"
                        name="password"
                        value={data.password}
                        autoComplete="current-password"
                        handleChange={onHandleChange}
                    />
                </div>
                <div>
                    <label>
                        <Checkbox name="remember" value={data.remember} handleChange={onHandleChange} />
                        <span>Remember me</span>
                    </label>
                </div>
                <div>
                    <Link href={route('register')}>
                        Register
                    </Link>
                    {canResetPassword && (
                        <Link href={route('password.request')}>
                            Reset Password
                        </Link>
                    )}
                    <Button processing={processing}>
                        Log in
                    </Button>
                </div>
            </form>
        </Guest>
    );
}
