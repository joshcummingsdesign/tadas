/** @jsxImportSource @emotion/react */
import React from "react";
import Link from "@/Components/Link";
import Auth from "@/Layouts/Auth";
import { Alert, Button, Typography } from "@mui/material";
import { useForm } from "@inertiajs/inertia-react";
import { css } from "@emotion/react";

/**
 * Verify email page.
 *
 * @unreleased
 */
export default function VerifyEmail({ status }) {
  const { post, processing } = useForm();

  const submit = (e) => {
    e.preventDefault();
    post(route("verification.send"));
  };

  return (
    <Auth title={"Email Verification"}>
      <Typography
        css={css`
          margin-bottom: 30px;
        `}
        color="text.secondary"
      >
        Thanks for signing up! Before getting started, could you verify your
        email address by clicking on the link we just emailed to you? If you
        didn't receive the email, we will gladly send you another one.
      </Typography>

      <form onSubmit={submit}>
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
          Resend Verification Email
        </Button>

        <Link href={route("logout")} method="post">
          Log out
        </Link>
      </form>

      {status === "verification-link-sent" && (
        <Alert
          css={css`
            margin-top: 30px;
          `}
          severity="success"
        >
          A new verification link has been sent to the email address you
          provided during registration.
        </Alert>
      )}
    </Auth>
  );
}
