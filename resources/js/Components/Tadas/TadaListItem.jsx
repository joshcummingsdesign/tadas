import React from "react";
import { MoreHoriz } from "@mui/icons-material";
import {
  ListItem,
  ListItemText,
  ListItemButton,
  IconButton,
} from "@mui/material";

export default function TadaListItem({ selected }) {
  return (
    <ListItem selected={selected} disablePadding={true}>
      <ListItemButton>
        <ListItemText primary="My Tada List" />
        <IconButton>
          <MoreHoriz />
        </IconButton>
      </ListItemButton>
    </ListItem>
  );
}
