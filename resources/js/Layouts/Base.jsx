import React, { useState, useMemo } from "react";
import Nav from "@/Components/Nav";
import { getDesignTokens } from "@/Layouts/theme";
import { ThemeProvider, CssBaseline, createTheme } from "@mui/material";

export default function Base({ auth, children }) {
  const [mode, setMode] = useState("light");

  const theme = useMemo(() => createTheme(getDesignTokens(mode)), [mode]);

  const toggleTheme = () =>
    setMode((prevMode) => (prevMode === "light" ? "dark" : "light"));

  return (
    <ThemeProvider theme={theme}>
      <CssBaseline />
      <header>
        <Nav auth={auth} theme={theme} toggleTheme={toggleTheme} />
      </header>
      <main>{children}</main>
    </ThemeProvider>
  );
}
