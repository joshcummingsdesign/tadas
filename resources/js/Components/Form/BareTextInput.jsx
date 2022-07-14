/** @jsxImportSource @emotion/react */
import React from "react";
import { css } from "@emotion/react";
import { useTheme } from "@mui/material";

/**
 * BareTextInput component.
 *
 * @since 1.0.0
 */
export default function BareTextInput({ className, variant, ...props }) {
  const theme = useTheme();

  return (
    <input
      css={css`
        background: none;
        border: none;
        outline: none;
        padding: 0;
        width: 100%;
        color: ${theme.palette.text.primary};
        font-family: ${theme.typography[variant].fontFamily};
        letter-spacing: ${theme.typography[variant].letterSpacing};
        line-height: ${theme.typography[variant].lineHeight};
        font-size: ${theme.typography[variant].fontSize};
        font-weight: ${theme.typography[variant].fontWeight};
      `}
      type="text"
      className={className}
      {...props}
    />
  );
}
