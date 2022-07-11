/** @jsxImportSource @emotion/react */
import React from "react";
import AddButton from "@/Components/AddButton";
import TadaListItem from "@/Components/Tadas/TadaListItem";
import { css } from "@emotion/react";
import { useTheme, List } from "@mui/material";

export default function TadaListSidebar() {
  const theme = useTheme();

  return (
    <section
      css={css`
        height: calc(100vh - 64px);
        width: 300px;
        overflow-y: auto;
      `}
    >
      <List>
        {[1].map((v, i) => (
          <TadaListItem key={i} selected={true} />
        ))}
        <AddButton />
      </List>
    </section>
  );
}
