/** @jsxImportSource @emotion/react */
import React from "react";
import Base from "@/Layouts/Base";
import ErrorSnackbar from "@/Components/Error/ErrorSnackbar";
import NoTadasFound from "@/Components/Tadas/NoTadasFound";
import TadaListItems from "@/Components/Tadas/TadaListItems";
import TadaListMain from "@/Components/Tadas/TadaListMain";
import TadaListSidebar from "@/Components/Tadas/TadaListSidebar";
import { Head } from "@inertiajs/inertia-react";
import { css } from "@emotion/react";
import { useMediaQuery, useTheme } from "@mui/material";

/**
 * Tadas layout.
 *
 * @since 1.0.0
 */
export default function Tadas({
  auth,
  errors,
  isAddTadaListFocused,
  isAddTadaFocused,
  listId,
  tadaLists,
  tadaList,
  tadas,
}) {
  const theme = useTheme();
  const isDesktop = useMediaQuery(theme.breakpoints.up("md"));

  return (
    <Base
      auth={auth}
      drawerItems={() => (
        <TadaListItems listId={listId} tadaLists={tadaLists || []} />
      )}
    >
      <Head title={tadaList ? tadaList.name : "Welcome"} />

      <ErrorSnackbar errors={errors} />

      <div
        css={css`
          ${theme.breakpoints.up("md")} {
            display: flex;
          }
        `}
      >
        {isDesktop && (
          <TadaListSidebar
            isAddTadaListFocused={isAddTadaListFocused}
            listId={listId}
            tadaLists={tadaLists || []}
          />
        )}
        {tadaLists && tadaLists.length ? (
          <TadaListMain
            isAddTadaFocused={isAddTadaFocused}
            tadaList={tadaList}
            tadas={tadas || []}
          />
        ) : (
          <NoTadasFound />
        )}
      </div>
    </Base>
  );
}
