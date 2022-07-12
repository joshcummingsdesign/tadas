/** @jsxImportSource @emotion/react */
import React from "react";
import Base from "@/Layouts/Base";
import TadaListMain from "@/Components/Tadas/TadaListMain";
import TadaListSidebar from "@/Components/Tadas/TadaListSidebar";
import { Head } from "@inertiajs/inertia-react";
import { css } from "@emotion/react";
import { useMediaQuery, useTheme } from "@mui/material";
import TadaListItems from "@/Components/Tadas/TadaListItems";

/**
 * Tadas layout.
 *
 * @unreleased
 */
export default function Tadas({ auth, listId, tadaLists, tadaList, tadas }) {
  const theme = useTheme();
  const isDesktop = useMediaQuery(theme.breakpoints.up("md"));

  return (
    <Base
      auth={auth}
      drawerItems={() => (
        <TadaListItems listId={listId} tadaLists={tadaLists || []} />
      )}
    >
      <Head title={tadaList ? tadaList.name : "Tadas"} />
      <div
        css={css`
          display: flex;
        `}
      >
        {isDesktop && (
          <TadaListSidebar listId={listId} tadaLists={tadaLists || []} />
        )}
        <TadaListMain tadaList={tadaList} tadas={tadas || []} />
      </div>
    </Base>
  );
}
