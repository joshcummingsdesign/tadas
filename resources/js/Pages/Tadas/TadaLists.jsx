import React from "react";
import Tadas from "@/Layouts/Tadas";

export default function TadaList({ auth, tadaLists }) {
  return <Tadas auth={auth} tadaLists={tadaLists} />;
}
