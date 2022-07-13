/** @jsxImportSource @emotion/react */
import React, { useEffect } from "react";
import Auth from "@/Layouts/Auth";
import Link from "@/Components/Link";
import { useForm } from "@inertiajs/inertia-react";
import { css } from "@emotion/react";
import {
  Button,
  TextField,
  Typography,
  Checkbox,
  FormGroup,
  FormControlLabel,
} from "@mui/material";

/**
 * Login page.
 *
 * @unreleased
 */
export default function Login({ status, canResetPassword }) {
  const { data, setData, post, processing, errors, reset } = useForm({
    email: "",
    password: "",
    remember: false,
  });

  useEffect(() => {
    return () => {
      reset("password");
    };
  }, []);

  const onHandleChange = (event) => {
    setData(
      event.target.name,
      event.target.type === "checkbox"
        ? event.target.checked
        : event.target.value
    );
  };

  const submit = (e) => {
    e.preventDefault();
    post(route("login"));
  };

  return (
    <Auth title={"Log in"} errors={errors} status={status}>
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

        <TextField
          css={css`
            width: 100%;
            margin-bottom: 20px;
          `}
          id="password"
          name="password"
          label="Password"
          type="password"
          autoComplete="current-password"
          required={true}
          value={data.password}
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
          Log in
        </Button>

        <FormGroup>
          <FormControlLabel
            label="Remember Me"
            control={
              <Checkbox
                name="remember"
                checked={data.remember}
                onChange={onHandleChange}
              />
            }
          />
        </FormGroup>

        <div
          css={css`
            margin: 10px 0;
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
            Don't have an account?
          </Typography>

          <Link href={route("register")}>Sign up</Link>
        </div>

        {canResetPassword && (
          <Link href={route("password.request")}>Forgot password?</Link>
        )}
      </form>
    </Auth>
  );
}
