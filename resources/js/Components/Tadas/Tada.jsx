/** @jsxImportSource @emotion/react */
import React, { useState } from "react";
import { Link } from "@inertiajs/inertia-react";
import { MoreHoriz } from "@mui/icons-material";
import { css } from "@emotion/react";
import {
  Paper,
  ListItem,
  ListItemText,
  IconButton,
  Checkbox,
  ListItemIcon,
  useTheme,
  Menu,
  MenuItem,
} from "@mui/material";
import { Inertia } from "@inertiajs/inertia";

export default function Tada({ className, tada }) {
  const theme = useTheme();

  const [anchorEl, setAnchorEl] = useState(null);

  const handleClose = (e) => {
    e.stopPropagation();
    setAnchorEl(null);
  };

  const onEdit = (e) => {
    e.stopPropagation();
    setAnchorEl(e.currentTarget);
  };

  const onDelete = (e, id) => {
    e.stopPropagation();
    Inertia.delete(route("tadas.destroy", id), { replace: true });
  };

  return (
    <Paper className={className} elevation={3} sx={{ padding: "0.5rem" }}>
      <ListItem disablePadding={true}>
        <ListItemIcon>
          <Checkbox />
        </ListItemIcon>
        <ListItemText sx={{ fontWeight: "bold" }} primary={tada.name} />
        <IconButton onClick={onEdit}>
          <MoreHoriz />
        </IconButton>
        <Menu
          id={`menu-tada-item-${tada.id}`}
          anchorEl={anchorEl}
          anchorOrigin={{
            vertical: "top",
            horizontal: "right",
          }}
          keepMounted
          transformOrigin={{
            vertical: "top",
            horizontal: "right",
          }}
          open={Boolean(anchorEl)}
          onClose={handleClose}
        >
          <MenuItem
            css={css`
              color: ${theme.palette.error.main};
            `}
            onClick={(e) => onDelete(e, tada.id)}
          >
            Delete
          </MenuItem>
        </Menu>
      </ListItem>
    </Paper>
  );
}
