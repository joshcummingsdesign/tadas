/** @jsxImportSource @emotion/react */
import React from "react";
import Tada from "@/Components/Tadas/Tada";
import { css } from "@emotion/react";
import { useTheme, Container, Typography, Stack } from "@mui/material";
import AddButton from "@/Components/AddButton";

const tadaWidth = "500px";

export default function TadaListMain() {
  const theme = useTheme();

  return (
    <section
      css={css`
        padding: 24px 0;
        height: calc(100vh - 56px);
        width: 100%;
        overflow-y: auto;
        background-color: ${theme.palette.mode === "light"
          ? "rgba(0,0,0,0.03)"
          : "rgba(255,255,255,0.03)"};

        ${theme.breakpoints.up("sm")} {
          height: calc(100vh - 64px);
        }

        ${theme.breakpoints.up("md")} {
          width: calc(100% - 300px);
        }
      `}
    >
      <Container>
        <Typography
          variant="h1"
          css={css`
            margin-bottom: 30px;
          `}
        >
          My Tada List
        </Typography>
        <Stack spacing={3}>
          {[1].map((v, i) => (
            <Tada
              css={css`
                max-width: ${tadaWidth};
              `}
              key={i}
            />
          ))}
          <AddButton
            css={css`
              max-width: ${tadaWidth};
            `}
            disablePadding={true}
          />
        </Stack>
      </Container>
    </section>
  );
}
