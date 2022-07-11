import React from "react";
import { MoreHoriz } from "@mui/icons-material";
import {
  Paper,
  ListItem,
  ListItemText,
  IconButton,
  Checkbox,
  ListItemIcon,
} from "@mui/material";

export default function Tada({ className }) {
  return (
    <Paper className={className} elevation={3} sx={{ padding: "0.5rem" }}>
      <ListItem disablePadding={true}>
        <ListItemIcon>
          <Checkbox />
        </ListItemIcon>
        <ListItemText sx={{ fontWeight: "bold" }} primary="My Tada List" />
        <IconButton>
          <MoreHoriz />
        </IconButton>
      </ListItem>
    </Paper>
  );
}
