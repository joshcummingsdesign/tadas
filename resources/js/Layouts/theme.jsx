import { createTheme } from "@mui/material/styles";
import { grey } from "@mui/material/colors";

export const getDesignTokens = (mode) =>
  createTheme({
    palette: {
      mode,
    },
    typography: {
      h1: {
        fontSize: "3rem",
        fontWeight: 500,
      },
      h3: {
        fontWeight: 500,
      },
    },
    components: {
      MuiListItemButton: {
        styleOverrides: {
          root: {
            "&:hover": {
              backgroundColor: mode === "light" ? grey[300] : grey[900],
            },
          },
        },
      },
    },
  });
