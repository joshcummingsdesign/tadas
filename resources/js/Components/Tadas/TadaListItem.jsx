/** @jsxImportSource @emotion/react */
import React, { useState } from "react";
import { Inertia } from "@inertiajs/inertia";
import { Link } from "@inertiajs/inertia-react";
import { MoreHoriz } from "@mui/icons-material";
import { css } from "@emotion/react";
import {
  useTheme,
  ListItem,
  ListItemText,
  ListItemButton,
  IconButton,
  Menu,
  MenuItem,
} from "@mui/material";

/**
 * TadaListItem component.
 *
 * @since 1.0.0
 */
export default function TadaListItem({ tadaList, selected }) {
  const [anchorEl, setAnchorEl] = useState(null);

  const theme = useTheme();

  const handleClose = (e) => {
    e.stopPropagation();
    setAnchorEl(null);
  };

  const onClick = (e, id) => {
    e.stopPropagation();
    Inertia.get(route("tadaLists.show", id), {}, { replace: true });
  };

  const onEdit = (e) => {
    e.stopPropagation();
    setAnchorEl(e.currentTarget);
  };

  const onDelete = (e, id) => {
    handleClose(e);
    Inertia.delete(route("tadaLists.destroy", id), { replace: true });
  };

  return (
    <ListItem selected={selected} disablePadding={true}>
      <ListItemButton onClick={(e) => onClick(e, tadaList.id)}>
        <ListItemText primary={tadaList.name} />
        <IconButton onClick={(e) => onEdit(e, tadaList.id)}>
          <MoreHoriz />
        </IconButton>
        <Menu
          id={`menu-tada-list-item-${tadaList.id}`}
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
            onClick={(e) => onDelete(e, tadaList.id)}
          >
            Delete
          </MenuItem>
        </Menu>
      </ListItemButton>
    </ListItem>
  );
}
