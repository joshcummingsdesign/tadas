/** @jsxImportSource @emotion/react */
import React, { useEffect } from "react";
import Auth from "@/Layouts/Auth";
import { useForm } from "@inertiajs/inertia-react";
import { TextField, Typography, Button } from "@mui/material";
import { css } from "@emotion/react";

export default function ConfirmPassword() {
  const { data, setData, post, processing, errors, reset } = useForm({
    password: "",
  });

  useEffect(() => {
    return () => {
      reset("password");
    };
  }, []);

  const onHandleChange = (event) => {
    setData(event.target.name, event.target.value);
  };

  const submit = (e) => {
    e.preventDefault();
    post(route("password.confirm"));
  };

  return (
    <Auth title={"Confirm Password"} errors={errors} status={status}>
      <Typography
        css={css`
          margin-bottom: 30px;
        `}
        color="text.secondary"
      >
        This is a secure area of the application. Please confirm your password
        before continuing.
      </Typography>

      <form onSubmit={submit}>
        <TextField
          css={css`
            width: 100%;
            margin-bottom: 20px;
          `}
          id="password"
          name="password"
          label="Password"
          type="password"
          required={true}
          autoFocus={true}
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
          Confirm
        </Button>
      </form>
    </Auth>
  );
}
