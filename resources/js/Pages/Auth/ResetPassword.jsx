/** @jsxImportSource @emotion/react */
import React, { useEffect } from "react";
import Auth from "@/Layouts/Auth";
import { useForm } from "@inertiajs/inertia-react";
import { TextField, Button, Typography } from "@mui/material";
import { css } from "@emotion/react";
import Link from "@/Components/Link";

export default function ResetPassword({ token, email }) {
  const { data, setData, post, processing, errors, reset } = useForm({
    token: token,
    email: email,
    password: "",
    password_confirmation: "",
  });

  useEffect(() => {
    return () => {
      reset("password", "password_confirmation");
    };
  }, []);

  const onHandleChange = (event) => {
    setData(event.target.name, event.target.value);
  };

  const submit = (e) => {
    e.preventDefault();
    post(route("password.update"));
  };

  return (
    <Auth title={"Reset Password"} errors={errors} status={status}>
      <form onSubmit={submit}>
        <TextField
          css={css`
            width: 100%;
            margin-bottom: 20px;
          `}
          id="email"
          name="email"
          label="Email"
          type="email"
          autoComplete="username"
          required={true}
          value={data.email}
          onChange={onHandleChange}
        />

        <TextField
          css={css`
            width: 100%;
            margin-bottom: 20px;
          `}
          id="password"
          name="password"
          label="Password"
          type="password"
          autoComplete="new-password"
          required={true}
          value={data.password}
          onChange={onHandleChange}
        />

        <TextField
          css={css`
            width: 100%;
            margin-bottom: 20px;
          `}
          id="password-confirmation"
          name="password_confirmation"
          label="Confirm Password"
          type="password"
          required={true}
          value={data.password_confirmation}
          onChange={onHandleChange}
        />

        <Button
          css={css`
            width: 100%;
            padding: 15px;
            margin-bottom: 20px;
          `}
          type="submit"
          variant="contained"
          disabled={processing}
        >
          Reset Password
        </Button>

        <div
          css={css`
            margin-top: 10px;
            display: flex;
            justify-content: center;
          `}
        >
          <Typography
            css={css`
              margin-right: 5px;
            `}
            color="text.secondary"
          >
            Remember your password?
          </Typography>

          <Link href={route("login")}>Log in</Link>
        </div>
      </form>
    </Auth>
  );
}
