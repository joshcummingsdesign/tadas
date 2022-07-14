import React from "react";
import Tadas from "@/Layouts/Tadas";

/**
 * TadaLists page.
 *
 * @since 1.0.0
 */
export default function TadaList({ auth, errors, tadaLists }) {
  return (
    <Tadas
      auth={auth}
      errors={errors}
      isAddTadaListFocused={true}
      tadaLists={tadaLists}
    />
  );
}
