import React, { Fragment } from "react";
import Tadas from "@/Layouts/Tadas";
import ValidationErrors from "@/Components/ValidationErrors";

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
    <Fragment>
      <ValidationErrors errors={errors} />
      <Tadas
        auth={auth}
        listId={listId}
        tadaLists={tadaLists}
        tadaList={tadaList}
        tadas={tadas}
      />
    </Fragment>
  );
}
