import React, { useState, useMemo, useEffect } from "react";
import Nav from "@/Components/Nav";
import { getThemeObject } from "@/theme";
import { SnackbarProvider } from "notistack";
import {
  ThemeProvider,
  CssBaseline,
  createTheme,
  useMediaQuery,
} from "@mui/material";

/**
 * Base layout.
 *
 * @since 1.0.0
 */
export default function Base({ auth, drawerItems, children }) {
  const [mode, setMode] = useState("light");

  const theme = useMemo(() => createTheme(getThemeObject(mode)), [mode]);
  const prefersDarkMode = useMediaQuery("(prefers-color-scheme: dark)");

  // Get theme from either local storage or system settings
  useEffect(() => {
    const storedTheme = localStorage.getItem("theme");

    if (storedTheme) {
      setMode(storedTheme);
    } else {
      setMode(prefersDarkMode ? "dark" : "light");
    }
  }, [prefersDarkMode]);

  const toggleTheme = () => {
    setMode((prevMode) => {
      const newMode = prevMode === "light" ? "dark" : "light";
      localStorage.setItem("theme", newMode);
      return newMode;
    });
  };

  return (
    <ThemeProvider theme={theme}>
      <SnackbarProvider>
        <CssBaseline />
        <Nav auth={auth} drawerItems={drawerItems} toggleTheme={toggleTheme} />
        <main>{children}</main>
      </SnackbarProvider>
    </ThemeProvider>
  );
}
