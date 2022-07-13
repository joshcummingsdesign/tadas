import React from "react";
import Tadas from "@/Layouts/Tadas";

/**
 * TadaList page.
 *
 * @unreleased
 */
export default function TadaList({
  auth,
  errors,
  listId,
  tadaLists,
  tadaList,
  tadas,
}) {
  return (
    <Tadas
      auth={auth}
      errors={errors}
      listId={listId}
      tadaLists={tadaLists}
      tadaList={tadaList}
      tadas={tadas}
    />
  );
}
