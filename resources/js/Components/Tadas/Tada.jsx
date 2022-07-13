/** @jsxImportSource @emotion/react */
import React, { useState, useEffect } from "react";
import { MoreHoriz } from "@mui/icons-material";
import { css } from "@emotion/react";
import { Inertia } from "@inertiajs/inertia";
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
import BareTextInput from "@/Components/Form/BareTextInput";

/**
 * Tada component.
 *
 * @unreleased
 */
export default function Tada({ className, tada }) {
  const [titleText, setTitleText] = useState("");
  const [isCompleted, setIsCompleted] = useState(false);
  const [isEditingTitle, setIsEditingTitle] = useState(false);
  const [anchorEl, setAnchorEl] = useState(null);

  const theme = useTheme();

  useEffect(() => {
    setTitleText(tada ? tada.name : "");
    setIsCompleted(tada ? tada.is_completed : false);
  }, [tada]);

  const handleTitleChange = (e) => {
    setTitleText(e.target.value);
  };

  const handleTitleFocus = () => {
    setIsEditingTitle(true);
  };

  const handleCancel = () => {
    setIsEditingTitle(false);
    setTitleText(tada.name);
  };

  const handleTitleUpdate = () => {
    const name = titleText || "Untitled Item";

    setIsEditingTitle(false);
    setTitleText(name);

    Inertia.patch(route("tadas.update", tada.id), { name }, { replace: true });
  };

  const handelKeyDown = (e) => {
    if (e.key === "Enter") {
      handleTitleUpdate();
    }

    if (e.key === "Escape") {
      handleCancel();
    }
  };

  const handleToggleCheckbox = (e) => {
    const is_completed = e.target.checked;
    setIsCompleted(is_completed);
    Inertia.patch(
      route("tadas.update", tada.id),
      { is_completed },
      { replace: true }
    );
  };

  const handleMenuClose = (e) => {
    e.stopPropagation();
    setAnchorEl(null);
  };

  const handleMenuOpen = (e) => {
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
          <Checkbox onChange={handleToggleCheckbox} checked={isCompleted} />
        </ListItemIcon>
        {isEditingTitle ? (
          <BareTextInput
            css={css`
              width: 100%;
            `}
            variant="body1"
            autoFocus={true}
            onBlur={handleTitleUpdate}
            onKeyDown={handelKeyDown}
            onChange={handleTitleChange}
            value={titleText}
          />
        ) : (
          <ListItemText
            sx={{ fontWeight: "bold" }}
            primary={titleText}
            onClick={handleTitleFocus}
            onFocus={handleTitleFocus}
            tabIndex={0}
          />
        )}
        <IconButton onClick={handleMenuOpen}>
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
          onClose={handleMenuClose}
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
