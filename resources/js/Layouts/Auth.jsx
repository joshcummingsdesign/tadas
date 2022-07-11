/** @jsxImportSource @emotion/react */
import React from "react";
import Base from "@/Layouts/Base";
import ValidationErrors from "@/Components/ValidationErrors";
import { Head } from "@inertiajs/inertia-react";
import { css } from "@emotion/react";
import { Alert, Container, Paper, Typography } from "@mui/material";

export default function Auth({ title, errors, status, children }) {
  return (
    <Base>
      <Head title={title} />

      <Container
        css={css`
          padding: 60px 0;
        `}
      >
        <Typography
          css={css`
            margin-bottom: 60px;
            text-align: center;
            font-size: 6rem;
          `}
          variant="h1"
        >
          Tadas 🎉
        </Typography>

        <Paper
          elevation={7}
          css={css`
            max-width: 800px;
            margin: 60px auto 0;
            padding: 60px;
            text-align: center;
          `}
        >
          <Typography
            css={css`
              margin-bottom: 30px;
              text-align: center;
            `}
            variant="h3"
          >
            {title} 👇
          </Typography>

          {children}

          {errors && (
            <ValidationErrors
              css={css`
                margin-top: 30px;
              `}
              errors={errors}
            />
          )}

          {status && (
            <Alert
              css={css`
                margin-top: 30px;
              `}
              severity="success"
            >
              {status}
            </Alert>
          )}
        </Paper>
      </Container>
    </Base>
  );
}
