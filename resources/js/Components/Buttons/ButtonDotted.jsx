import React from "react";
import { useTheme, ListItemButton } from "@mui/material";

/**
 * AddButton component.
 *
 * @unreleased
 */
export default function ButtonDotted({
  className,
  innerRef,
  onClick,
  children,
}) {
  const theme = useTheme();

  return (
    <ListItemButton
      className={className}
      ref={innerRef}
      onClick={onClick}
      sx={{
        textAlign: "center",
        border: "2px dotted",
        borderColor: "grey.500",
        borderRadius: 3,
        backgroundColor:
          theme.palette.mode === "light"
            ? "rgba(0,0,0,0.03)"
            : "rgba(255,255,255,0.03)",
      }}
    >
      {children}
    </ListItemButton>
  );
}
