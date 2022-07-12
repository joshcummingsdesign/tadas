/** @jsxImportSource @emotion/react */
import React from "react";
import TadaListItems from "@/Components/Tadas/TadaListItems";
import { css } from "@emotion/react";

export default function TadaListSidebar({ listId, tadaLists }) {
  return (
    <section
      css={css`
        height: calc(100vh - 64px);
        width: 300px;
        overflow-y: auto;
      `}
    >
      <TadaListItems listId={listId} tadaLists={tadaLists} />
    </section>
  );
}
