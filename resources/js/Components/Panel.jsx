/** @jsxImportSource @emotion/react */
import React from "react";
import { css } from "@emotion/react";
import { useTheme } from "@mui/material";

/**
 * Panel component.
 *
 * @since 1.2.0
 */
export default function NoTadasFound({ children }) {
  const theme = useTheme();

  return (
    <section
      css={css`
        width: 100%;
        overflow-y: auto;
        height: calc(100vh - 56px);
        padding: 30px 16px;
        background-color: ${theme.palette.mode === "light"
          ? "rgba(0,0,0,0.03)"
          : "rgba(255,255,255,0.03)"};

        ${theme.breakpoints.up("sm")} {
          padding: 30px;
          height: calc(100vh - 64px);
        }

        ${theme.breakpoints.up("md")} {
          width: calc(100% - 300px);
        }
      `}
    >
      {children}
    </section>
  );
}
