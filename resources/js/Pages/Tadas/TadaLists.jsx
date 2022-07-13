import React from "react";
import Tadas from "@/Layouts/Tadas";

/**
 * TadaLists page.
 *
 * @unreleased
 */
export default function TadaList({ auth, errors, tadaLists }) {
  return <Tadas auth={auth} errors={errors} tadaLists={tadaLists} />;
}
