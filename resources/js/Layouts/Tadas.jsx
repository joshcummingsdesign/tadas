/** @jsxImportSource @emotion/react */
import React from "react";
import Base from "@/Layouts/Base";
import TadaListMain from "@/Components/Tadas/TadaListMain";
import TadaListSidebar from "@/Components/Tadas/TadaListSidebar";
import { Head } from "@inertiajs/inertia-react";
import { css } from "@emotion/react";
import { useMediaQuery, useTheme } from "@mui/material";
import TadaListItems from "@/Components/Tadas/TadaListItems";

export default function Tadas({ auth, tadaLists, tadas }) {
  const theme = useTheme();
  const isDesktop = useMediaQuery(theme.breakpoints.up("md"));

  return (
    <Base auth={auth} drawerItems={() => <TadaListItems items={tadaLists} />}>
      <Head title="Tadas" />
      <div
        css={css`
          display: flex;
        `}
      >
        {isDesktop && <TadaListSidebar tadaLists={tadaLists} />}
        <TadaListMain tadaListName="My Tada List" tadas={tadas} />
      </div>
    </Base>
  );
}
