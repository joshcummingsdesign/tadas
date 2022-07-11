/** @jsxImportSource @emotion/react */
import React from "react";
import Base from "@/Layouts/Base";
import TadaListMain from "@/Components/Tadas/TadaListMain";
import TadaListSidebar from "@/Components/Tadas/TadaListSidebar";
import { Head } from "@inertiajs/inertia-react";
import { css } from "@emotion/react";
import { useMediaQuery, useTheme } from "@mui/material";

export default function TadaList({ auth }) {
  const theme = useTheme();
  const isDesktop = useMediaQuery(theme.breakpoints.up("md"));

  return (
    <Base auth={auth} drawerItems={[1]}>
      <Head title="Tadas" />
      <div
        css={css`
          display: flex;
        `}
      >
        {isDesktop && <TadaListSidebar items={[1]} />}
        <TadaListMain />
      </div>
    </Base>
  );
}
