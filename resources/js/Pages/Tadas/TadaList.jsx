import React from "react";
import Tadas from "@/Layouts/Tadas";

export default function TadaList({ auth, listId, tadaLists, tadaList, tadas }) {
  return (
    <Tadas
      auth={auth}
      listId={listId}
      tadaLists={tadaLists}
      tadaList={tadaList}
      tadas={tadas}
    />
  );
}
