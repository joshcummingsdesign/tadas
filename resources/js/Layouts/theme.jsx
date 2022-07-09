import { createTheme } from "@mui/material/styles";

export const getDesignTokens = (mode) =>
  createTheme({
    palette: {
      mode,
    },
    typography: {
      h1: {
        fontWeight: 500,
      },
      h3: {
        fontWeight: 500,
      },
    },
  });
