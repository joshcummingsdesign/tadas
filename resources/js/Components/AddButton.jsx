import React from "react";
import {
  useTheme,
  ListItem,
  ListItemText,
  ListItemButton,
} from "@mui/material";

/**
 * AddButton component.
 *
 * @since 1.0.0
 */
export default function AddButton({
  className,
  innerRef,
  onClick,
  disablePadding,
}) {
  const theme = useTheme();

  return (
    <ListItem className={className} disablePadding={disablePadding}>
      <ListItemButton
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
        <ListItemText primary="+" />
      </ListItemButton>
    </ListItem>
  );
}
