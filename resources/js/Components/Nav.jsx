/** @jsxImportSource @emotion/react */
import React, { Fragment, useState } from "react";
import { Link } from "@inertiajs/inertia-react";
import { css } from "@emotion/react";
import { AccountCircle, LightMode, DarkMode } from "@mui/icons-material";
import {
  Menu,
  MenuItem,
  AppBar,
  Toolbar,
  Typography,
  IconButton,
} from "@mui/material";

export default function Nav({ auth, theme, toggleTheme }) {
  const [anchorEl, setAnchorEl] = useState(null);

  const handleMenu = (event) => {
    setAnchorEl(event.currentTarget);
  };

  const handleClose = () => {
    setAnchorEl(null);
  };

  return (
    <AppBar position="static">
      <Toolbar>
        <Typography variant="h6" component="div" sx={{ flexGrow: 1 }}>
          <Link
            css={css`
              color: #ffffff;
              text-decoration: none;
            `}
            href={route("home")}
          >
            Tadas 🎉
          </Link>
        </Typography>
        {auth && (
          <Fragment>
            <IconButton
              size="large"
              aria-label="account of current user"
              aria-controls="menu-appbar"
              aria-haspopup="true"
              onClick={handleMenu}
              color="inherit"
            >
              <AccountCircle />
            </IconButton>
            <Menu
              id="menu-appbar"
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
              <Link
                css={css`
                  background: none;
                  border: none;
                `}
                method="post"
                href={route("logout")}
                as="button"
              >
                <MenuItem>Log Out</MenuItem>
              </Link>
            </Menu>
          </Fragment>
        )}
        <IconButton color="inherit" size="large" onClick={toggleTheme}>
          {theme.palette.mode === "light" ? <DarkMode /> : <LightMode />}
        </IconButton>
      </Toolbar>
    </AppBar>
  );
}
