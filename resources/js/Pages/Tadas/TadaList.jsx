/** @jsxImportSource @emotion/react */
import React from "react";
import Base from "@/Layouts/Base";
import TadaListMain from "@/Components/Tadas/TadaListMain";
import TadaListSidebar from "@/Components/Tadas/TadaListSidebar";
import { Head } from "@inertiajs/inertia-react";
import { css } from "@emotion/react";

export default function TadaList({ auth }) {
  return (
    <Base auth={auth}>
      <Head title="Tadas" />
      <div
        css={css`
          display: flex;
        `}
      >
        <TadaListSidebar />
        <TadaListMain />
      </div>
    </Base>
  );
}
