/** @jsxImportSource @emotion/react */
import React from "react";
import { Link } from "@inertiajs/inertia-react";
import { css } from "@emotion/react";
import { useTheme } from "@mui/material";

/**
 * Link component.
 *
 * @since 1.0.0
 */
export default function StyledLink({ children, ...props }) {
  const theme = useTheme();

  return (
    <Link
      css={css`
        color: ${theme.palette.secondary.main};
        text-decoration: none;

        &:hover {
          text-decoration: underline;
        }
      `}
      {...props}
    >
      {children}
    </Link>
  );
}
