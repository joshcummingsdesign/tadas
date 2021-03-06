/** @jsxImportSource @emotion/react */
import React from "react";
import TadaListItems from "@/Components/Tadas/TadaListItems";
import { css } from "@emotion/react";

/**
 * TadaListSidebar component.
 *
 * @since 1.0.0
 */
export default function TadaListSidebar({
  isAddTadaListFocused,
  listId,
  tadaLists,
}) {
  return (
    <section
      css={css`
        height: calc(100vh - 64px);
        width: 300px;
        overflow-y: auto;
      `}
    >
      <TadaListItems
        isAddTadaListFocused={isAddTadaListFocused}
        listId={listId}
        tadaLists={tadaLists}
      />
    </section>
  );
}
