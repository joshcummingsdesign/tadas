/** @jsxImportSource @emotion/react */
import React from "react";
import Auth from "@/Layouts/Auth";
import { useForm } from "@inertiajs/inertia-react";
import { TextField, Button, Typography } from "@mui/material";
import { css } from "@emotion/react";
import Link from "@/Components/Link";

/**
 * ForgotPassword page.
 *
 * @since 1.0.0
 */
export default function ForgotPassword({ status }) {
  const { data, setData, post, processing, errors } = useForm({
    email: "",
  });

  const onHandleChange = (event) => {
    setData(event.target.name, event.target.value);
  };

  const submit = (e) => {
    e.preventDefault();
    post(route("password.email"));
  };

  return (
    <Auth title={"Reset Password"} errors={errors} status={status}>
      <Typography
        css={css`
          margin-bottom: 30px;
        `}
        color="text.secondary"
      >
        Forgot your password? No problem. Just let us know your email address
        and we will email you a password reset link that will allow you to
        choose a new one.
      </Typography>

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
          autoFocus={true}
          value={data.email}
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
