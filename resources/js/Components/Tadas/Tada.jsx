/** @jsxImportSource @emotion/react */
import React, { useState, useEffect } from "react";
import BareTextInput from "@/Components/Form/BareTextInput";
import { Inertia } from "@inertiajs/inertia";
import { MoreHoriz, DragIndicator } from "@mui/icons-material";
import { css } from "@emotion/react";
import { strings } from "@/strings";
import { Draggable } from "react-beautiful-dnd";
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

/**
 * Tada component.
 *
 * @since 1.0.0
 */
export default function Tada({
  className,
  editOnInit,
  tada,
  index,
  isDragging,
  onTadaTitleBlur,
  onTadaInputEnterKey,
}) {
  const [titleText, setTitleText] = useState("");
  const [isCompleted, setIsCompleted] = useState(false);
  const [isEditingTitle, setIsEditingTitle] = useState(false);
  const [anchorEl, setAnchorEl] = useState(null);

  const theme = useTheme();

  useEffect(() => {
    if (isDragging && isEditingTitle) {
      handleBlur();
    }
  }, [isDragging, isEditingTitle]);

  useEffect(() => {
    if (editOnInit) {
      setIsEditingTitle(true);
    }
  }, [editOnInit]);

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

  const handleTitleInputFocus = (e) => {
    e.target.select();
  };

  const handleCancel = () => {
    setIsEditingTitle(false);
    setTitleText(tada.name);
  };

  const handleTitleUpdate = () => {
    const name = titleText || strings.defaultTadaTitle;

    setIsEditingTitle(false);
    setTitleText(name);

    Inertia.patch(route("tadas.update", tada.id), { name }, { replace: true });
  };

  const handleBlur = () => {
    onTadaTitleBlur();
    handleTitleUpdate();
  };

  const handelKeyDown = (e) => {
    if (e.key === "Enter") {
      handleTitleUpdate();
      onTadaInputEnterKey();
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
    handleMenuClose(e);
    Inertia.delete(route("tadas.destroy", id), { replace: true });
  };

  return (
    <Draggable draggableId={`tada-${tada.id}`} index={index}>
      {({ draggableProps, dragHandleProps, innerRef }) => (
        <div
          css={css`
            margin-bottom: ${theme.spacing(3)};
          `}
          {...draggableProps}
          ref={innerRef}
        >
          <Paper className={className} elevation={3} sx={{ padding: "0.5rem" }}>
            <ListItem disablePadding={true}>
              <div
                css={css`
                  display: flex;
                  align-items: center;
                `}
                {...dragHandleProps}
              >
                <DragIndicator sx={{ color: "grey.500" }} />
              </div>
              <ListItemIcon>
                <Checkbox
                  onChange={handleToggleCheckbox}
                  checked={isCompleted}
                />
              </ListItemIcon>
              {isEditingTitle ? (
                <BareTextInput
                  css={css`
                    width: 100%;
                  `}
                  variant="body1"
                  autoFocus={true}
                  onFocus={handleTitleInputFocus}
                  onBlur={handleBlur}
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
        </div>
      )}
    </Draggable>
  );
}
