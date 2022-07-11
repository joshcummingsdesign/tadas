import React, { useState, useMemo } from "react";
import Nav from "@/Components/Nav";
import { getDesignTokens } from "@/Layouts/theme";
import { ThemeProvider, CssBaseline, createTheme } from "@mui/material";

export default function Base({ auth, drawerItems, children }) {
  const [mode, setMode] = useState("light");

  const theme = useMemo(() => createTheme(getDesignTokens(mode)), [mode]);

  const toggleTheme = () =>
    setMode((prevMode) => (prevMode === "light" ? "dark" : "light"));

  return (
    <ThemeProvider theme={theme}>
      <CssBaseline />
      <Nav
        auth={auth}
        theme={theme}
        drawerItems={drawerItems}
        toggleTheme={toggleTheme}
      />
      <main>{children}</main>
    </ThemeProvider>
  );
}
