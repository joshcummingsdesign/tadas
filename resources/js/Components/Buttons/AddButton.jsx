import React from "react";
import { ListItem, ListItemText } from "@mui/material";
import ButtonDotted from "@/Components/Buttons/ButtonDotted";

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
  return (
    <ListItem className={className} disablePadding={disablePadding}>
      <ButtonDotted innerRef={innerRef} onClick={onClick}>
        <ListItemText primary="+" />
      </ButtonDotted>
    </ListItem>
  );
}
