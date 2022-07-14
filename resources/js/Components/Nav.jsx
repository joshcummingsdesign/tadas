/** @jsxImportSource @emotion/react */
import React, { Fragment, useState } from "react";
import { Link } from "@inertiajs/inertia-react";
import { css } from "@emotion/react";
import {
  AccountCircle,
  LightMode,
  DarkMode,
  Menu as MenuIcon,
} from "@mui/icons-material";
import {
  useMediaQuery,
  Menu,
  MenuItem,
  AppBar,
  Toolbar,
  Typography,
  IconButton,
  Drawer,
  Button,
  useTheme,
} from "@mui/material";

/**
 * Nav component.
 *
 * @since 1.0.0
 */
export default function Nav({ auth, toggleTheme, drawerItems }) {
  const [drawerIsOpen, setDrawerIsOpen] = useState(false);
  const [anchorEl, setAnchorEl] = useState(null);

  const theme = useTheme();
  const isMobile = useMediaQuery(theme.breakpoints.down("md"));

  const toggleDrawer = () => {
    setDrawerIsOpen((prevState) => !prevState);
  };

  const closeDrawer = () => {
    setDrawerIsOpen(false);
  };

  const handleMenu = (event) => {
    setAnchorEl(event.currentTarget);
  };

  const handleClose = () => {
    setAnchorEl(null);
  };

  return (
    <AppBar position="relative">
      <Toolbar>
        {drawerItems && isMobile && (
          <Fragment>
            <Button
              css={css`
                padding: 5px;
                margin-right: 10px;
                min-width: 0;
              `}
              variant="secondary"
              onClick={toggleDrawer}
            >
              <MenuIcon />
            </Button>
            <Drawer
              PaperProps={{ sx: { width: 300 } }}
              anchor="left"
              open={drawerIsOpen}
              onClose={closeDrawer}
            >
              {drawerItems()}
            </Drawer>
          </Fragment>
        )}
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
                  color: ${theme.palette.text.primary};
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
